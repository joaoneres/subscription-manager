<?php

namespace App\Http\Requests;

use App\Enums\PaymentRecurrencePeriodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'cover' => ['nullable', 'image', 'mimes:png,jpg'],
            'name' => ['nullable', 'min:5', 'max:50', 'string'],
            'description' => ['nullable', 'min:5', 'max:150', 'string'],
            'price' => ['nullable', 'numeric', 'max:10000000'],
            'recurrent' => ['nullable', Rule::in([0, 1])],
            'period' => ['nullable', Rule::in(PaymentRecurrencePeriodEnum::toArray())],
        ];
    }
}
