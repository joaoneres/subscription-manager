<?php

namespace App\Enums;

class LocaleEnum
{
    const SPANISH = 'es';
    const ENGLISH = 'en';
    const PORTUGUESE = 'pt';

    public static function toArray()
    {
        return [
            self::SPANISH,
            self::ENGLISH,
            self::PORTUGUESE,
        ];
    }

    public static function toSelectInput()
    {
        return [
            'es' => __('Spanish'),
            'en' => __('English'),
            'pt' => __('Portuguese'),
        ];
    }
}
