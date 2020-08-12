<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class resetFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'phone'=>'required|numeric',          
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'phone.numeric'=>'Vous devez entrer une valeur numeric',
            'phone.required'=>'Entrez votre numero telephone',
            'password.required'  => 'Vous devez entrer un mot de passe',
            'password.confirmed'=>' Confirmation mot de passe échoue',
            'password.min'=>"Mot de passe doit contenir minimums 6 caractères",
        ];
    }
}
