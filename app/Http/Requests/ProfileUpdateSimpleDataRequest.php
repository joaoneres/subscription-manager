<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpjRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateSimpleDataRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['nullable', 'min:5', 'max:150', 'string'],
            'document' => ['nullable', 'string', new CpfCnpjRule(), 'unique:users,document,'.request()->route()->originalParameters()['user']],
            'phone' => ['nullable', 'string', 'regex:/^\(?(?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/'],
        ];
    }
}
