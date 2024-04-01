<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class _BaseWebRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
//            'numbers.*' => __("Maʼlumotlar formati notoʻgʻri")
        ];
    }

}
