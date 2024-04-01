<?php

namespace App\Http\Requests\REST;

class MedicalHistoryRequest extends _BaseRestRequest
{
    public function rules(): array
    {
        return [
            'history' => 'required|string|min:2|max:150',
            'patient_id' => 'required|integer|min:1|exists:patients,id',
        ];
    }

}
