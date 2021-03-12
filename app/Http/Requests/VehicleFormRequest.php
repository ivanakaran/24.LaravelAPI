<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleFormRequest extends FormRequest
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
            'brand' => 'required',
            'model' => 'required',
            'plate_number' => 'required',
            'insurance_date' => 'required|date',
        ];
    }
// probuvav so ova posto ne mi gi prikazuva greskite on submit
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json($validator->errors(), 422));
    // }

}