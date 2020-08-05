<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerFormRequest extends FormRequest
{
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
    public function messages()
{
    return [
        'phone.numeric'=>'Vous devez entrer une valeur numeric',
        'phone.required'=>'Entrez votre numero telephone',
        'first_name.required' => 'Vous devez entrer un votre nom',
        'email.required'  => 'Vous devez entrer un email',
        'password.required'  => 'Vous devez entrer un mot de passe',
        'email.email' =>" L'email doit etre abc@exmple.com",
        'password.confirmed'=>' Confirmation mot de passe échoue',
        'password.min'=>"mot de passe doit contenir minimums 6 caractères",
        'max' => 'Vous avez entre une valeur tres lang',

    ];
}

    public function rules()
    {
        return [
            'phone'=>'required|numeric',          
            'first_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ];
    }
}
