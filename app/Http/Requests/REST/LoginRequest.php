<?php

namespace App\Http\Requests\REST;

class LoginRequest extends _BaseRestRequest
{
    public function rules(): array
    {
        return [
            'numbers' => 'required|integer|max_digits:6|min_digits:6'
        ];
    }

}
