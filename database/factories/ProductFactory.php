<?php

namespace Database\Factories;

use App\Enums\PaymentRecurrencePeriodEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text(150),
            'price' => $this->faker->numberBetween(10000, 100000),
            'recurrent' => $this->faker->boolean(65),
            'period' => $this->faker->randomElement(PaymentRecurrencePeriodEnum::toArray()),
        ];
    }
}
