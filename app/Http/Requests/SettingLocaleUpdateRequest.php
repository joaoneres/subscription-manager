<?php

namespace App\Http\Requests;

use App\Enums\LocaleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingLocaleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'locale' => [Rule::in(LocaleEnum::toArray())],
        ];
    }
}
