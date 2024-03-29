<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialtyRequest extends FormRequest
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
            'clinic_id' => 'required|exists:clinics,id',
            'name' => ['required','string',
                    Rule::unique('specialties')->where( function ($query){
                        return $query->where('clinic_id',$this->clinic_id)->where('name',$this->name);
                    })->ignore($this->route()->specialty)],
            'description' => 'nullable|string'
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
            'clinic_id' => 'sede',
        ];
    }

}
