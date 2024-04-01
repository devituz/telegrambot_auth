<?php

namespace App\Http\Requests\REST;

class PhoneRequest extends _BaseRestRequest
{
    public function rules(): array
    {
        return [
            'number' => 'required|integer|max:15',
            'patient_id' => 'required|integer|min:1|exists:patients,id',
        ];
    }

}
