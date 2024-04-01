<?php

namespace App\Http\Requests\REST;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class _BaseRestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'data' => $validator->errors()
        ]));
    }

    public function messages(): array
    {
        return [
//            'numbers.*' => __("Maʼlumotlar formati notoʻgʻri")
        ];
    }

}
