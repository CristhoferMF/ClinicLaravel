<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'document_type_id'=> ['required','exists:document_types,id'],
            'document_number' => ['required','integer','unique:doctors,document_number,'.$this->route()->doctor],
            'last_name' => ['required','string'],
            'first_name'=> ['required','string'],
            'gender' => ['required','in:M,F'],
            'status' => ['required','string','in:active,inactive'],
        ];
    }

    //
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'document_type_id' => 'tipo de documento',
        ];
    }
}
