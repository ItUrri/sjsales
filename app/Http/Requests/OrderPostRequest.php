<?php

namespace App\Http\Requests;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Entities\Area;

class OrderPostRequest extends FormRequest
{
    /**
     * @EntityManagerInterface
     */ 
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('area');
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }
        return [
            'credit' => "required|numeric|between:0,{$entity->getAvailableCredit()}",
            'products.*.supplier' => 'required',
            'products.*.detail'   => 'required|max:255',
            'products.*.credit'   => 'required|min:0',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            if (isset($data['custom']) && $data['custom']) {
                if (!isset($data['sequence']) || is_null($data['sequence']))
                $validator->errors()->add('sequence', 'Required field');
            }
        });
    }
}
