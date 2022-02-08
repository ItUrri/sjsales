<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPostRequest extends FormRequest
{
    public function __construct(\App\Entities\Area $e)
    {
        parent::__construct();
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
        return [
            'credit' => 'required|min:0',
            'products.*.supplier' => 'required',
            'products.*.detail'   => 'required|max:255',
            'products.*.credit'   => 'required|min:0',
        ];
    }
}
