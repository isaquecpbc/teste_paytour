<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsFormRequest extends FormRequest
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
            'name'         => 'required|min:3|max:100|string',
            'email'        => 'required|min:3|max:100|email|unique:contacts',
            'phone'        => 'required|min:8|max:11|unique:contacts',
            'desired_job'  => 'required|min:3|max:500',
            'education'    => 'required|min:5|max:100',
            'archive'      => 'file|max:1024|mimes:pdf,doc,docx|nullable',
        ];

    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
        ];
        return [
            'size' => 'O arquivo anexado deve ser menor que 1024kb.',
        ];

    }
}
