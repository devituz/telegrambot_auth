<?php

namespace App\Http\Requests\REST;

class PatientRequest extends _BaseRestRequest
{
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|min:3|max:20',
            'lastname' => 'required|string|min:3|max:20',
            'brith_day' => 'required|date',
            'gender' => 'required|string|min:1|max:10',
            'address' => 'required|string|min:3|max:250',
            'rengen' => 'required|string|min:1|max:50',
            'description' => 'nullable|string|min:1|max:500',
        ];
    }

}
