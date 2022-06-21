<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpjRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:150'],
            'document' => ['required', 'string', new CpfCnpjRule(), 'unique:users,document'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^\(?(?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
