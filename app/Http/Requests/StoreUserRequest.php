<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return true
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
            'uName' => 'required|min:3|max:15',
            'uEmail' => 'required|unique:users|min:11|max:50',
            'uPass' => 'required'
        ];
    }

    public function messages(){
        return [
            'required' => 'Polje :attribute je obavezno.',
            'unique' => 'Polje :attribute mora biti jedinstveno.',
            'uName.min' => 'Ime ne sme biti kraće od :min karaktera.',
            'uName.max' => 'Ime ne sme biti duže od :max karaktera.',
            'uEmail.min' => 'Email ne sme biti kraći od :min karaktera.',
            'uEmail.max' => 'Email ne sme biti duži od :max karaktera.'
        ];
    }
}
