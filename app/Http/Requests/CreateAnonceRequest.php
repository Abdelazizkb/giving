<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnonceRequest extends FormRequest
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


    public function messages()
    {
        return [
          
            'title.required' => 'Vous devez entrer un titre',
            'body.required'  => 'Vous devez entrer une description',
            'titre.max'=>"Vous avez depassse le nombre de caractère autorise",
            'image.required'=>'Téléchargez une photo',
            'date.required'=>'Vous devez entre une date'

        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'required|image',
            'date' => 'required|date',

        ];
    }
}
