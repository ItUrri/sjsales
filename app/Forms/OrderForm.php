<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class OrderForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('detail', Field::TEXT, [
                'rules' => 'required|min:3|max:255',
            ])
            ->add('products', 'collection', [
                'type' => 'form',
                'prototype' => true, 
                'prototype_name' => '__NAME__', 
                'options' => [
                    'class' => 'App\Forms\ProductForm',
                    'label' => false,
                    'empty_row' => false,
                ]
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ])
            ;
    }
}
