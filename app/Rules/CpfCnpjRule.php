<?php

namespace App\Rules;

use App\Enums\DocumentTypeEnum;
use Illuminate\Contracts\Validation\Rule;

class CpfCnpjRule implements Rule
{
    protected $person_type;

    public function __construct(Int $person_type = null)
    {
        $this->person_type = $person_type;
    }

    public function passes($attribute, $value) : Bool
    {
        switch ($this->person_type) {
            case null;
                return (new CpfRule)->passes($attribute, $value) || (new CnpjRule)->passes($attribute, $value);
                break;
            case DocumentTypeEnum::CPF:
                return (new CpfRule)->passes($attribute, $value);
                break;
            case DocumentTypeEnum::CNPJ:
                return (new CnpjRule)->passes($attribute, $value);
                break;
            default:
                return false;
                break;
        }
    }

    public function message() : String
    {
        if($this->person_type == DocumentTypeEnum::CPF) {
            return 'CPF inválido';
        } else if($this->person_type == DocumentTypeEnum::CNPJ) {
            return 'CNPJ inválido';
        }

        return 'CPF/CNPJ inválido';
    }
}
