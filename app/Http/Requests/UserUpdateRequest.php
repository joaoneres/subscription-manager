<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpjRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'min:5', 'max:150'],
            'document' => ['nullable', 'string', new CpfCnpjRule()],
            'email' => ['nullable', 'string', 'email', 'min:5', 'max:255'],
            'phone' => ['nullable', 'string', 'regex:/^\(?(?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/'],
            'is_admin' => ['nullable', 'boolean'],
        ];
    }
}
