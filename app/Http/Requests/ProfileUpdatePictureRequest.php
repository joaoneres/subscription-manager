<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpjRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdatePictureRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'image' => ['required', 'mimes:png,jpg', 'image', 'max:2000'],
        ];
    }
}
