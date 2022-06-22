<?php

namespace App\Http\Requests;

use App\Enums\PaymentRecurrencePeriodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $this->merge([
            'price' => $this->price * 100,
        ]);
    }

    public function rules()
    {
        return [
            'cover' => ['nullable', 'image', 'mimes:png,jpg'],
            'name' => ['required', 'min:5', 'max:50', 'string'],
            'description' => ['required', 'min:5', 'max:150', 'string'],
            'price' => ['required', 'numeric', 'max:10000000'],
            'recurrent' => ['required', Rule::in([0, 1])],
            'period' => ['required', Rule::in(PaymentRecurrencePeriodEnum::toArray())],
        ];
    }
}
