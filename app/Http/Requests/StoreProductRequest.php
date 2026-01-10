<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'pName' => 'required|min:3|max:35',
            'price' => 'required|numeric',
            'pEngName' => 'required|min:3|max:35',
            'image' => 'required|image'
        ];
    }

    public function messages(){
        return [
            'required' => 'Polje :attribute je obavezno.',
            'pName.min' => 'Naziv mora imati više od :min karaktera.',
            'pName.max' => 'Naziv mora imati manje od :max karaktera.',
            'pEngName.min' => 'Englegski naziv mora imati više od :min karaktera.',
            'pEngName.max' => 'Engleski naziv mora imati manje od :max karaktera.',
            'numeric' => 'Polje :attribute mora biti broj.',
            'image.image' => 'Postavljeni fajl mora biti tipa image.'
        ];
    }
}
