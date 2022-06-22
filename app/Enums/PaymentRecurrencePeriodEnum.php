<?php

namespace App\Enums;

class PaymentRecurrencePeriodEnum
{
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';

    public static function toArray()
    {
        return [
            self::DAILY,
            self::WEEKLY,
            self::MONTHLY,
            self::YEARLY,
        ];
    }

    public static function toSelectInput()
    {
        return [
            self::DAILY => __('Daily'),
            self::WEEKLY => __('Weekly'),
            self::MONTHLY => __('Monthly'),
            self::YEARLY => __('Yearly'),
        ];
    }
}
