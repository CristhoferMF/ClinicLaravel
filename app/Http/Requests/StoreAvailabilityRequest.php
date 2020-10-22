<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailabilityRequest extends FormRequest
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
            'doctor_id' => ['required','exists:doctors,id'],
            'specialty_id' => ['required','exists:specialties,id'],
            'day' => ['required','in:0,1,2,3,4,5,6'],
            'from_hour' => ['required','date_format:h:i A'],
            'to_hour' => ['required','date_format:h:i A','after:from_hour'],
            'max_patients' => ['required','integer'],
            'from_date' => ['required','date_format:d/m/Y'],
            'to_date' => ['sometimes','required','date_format:d/m/Y','after:from_date'],
            'status' => ['required','in:active,inactive'],
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
            'doctor_id' => 'doctor',
            'specialty_id' => 'especialidad',
            'max_patients' => 'max pacientes'
        ];
    }
}
