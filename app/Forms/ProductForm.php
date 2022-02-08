<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class ProductForm extends Form
{
    public function buildForm()
    {
        $this
            //->add('supplier', Field::ENTITY, [
            //    'class' => Supplier::class,
            //    'query_builder' => function (Supplier $suppliers) {
            //        return $suppliers->where('available', TRUE);
            //    }
            //])
            ->add('detail', Field::TEXT, [
                'rules' => 'required|min:3|max:255',
            ])
            ->add('count', Field::NUMBER, [
                'rules' => 'min:1',
            ])
            ->add('total', Field::NUMBER, [
                'rules' => 'min:1',
            ])
            //->add('submit', Field::BUTTON_SUBMIT, [
            //])
            ;
    }
}
