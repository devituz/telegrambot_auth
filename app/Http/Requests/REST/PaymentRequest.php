<?php

namespace App\Http\Requests\REST;

class PaymentRequest extends _BaseRestRequest
{
    public function rules(): array
    {
        return [
            'number' => 'required|string|min:3|max:100',
            'amount' => 'required|integer|min_digits:1|max_digits:50',
            'day' => 'required|date',
            'patient_id' => 'required|integer|min:1|exists:patients,id',
        ];
    }

}
