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
            self::SPANISH => __('Spanish'),
            self::ENGLISH => __('English'),
            self::PORTUGUESE => __('Portuguese'),
        ];
    }
}
