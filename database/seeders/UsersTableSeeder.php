<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $quantity = max((Int) $this->command->ask('How many users do you want to create?', 15), 1);
        User::factory()->admin()->create();
        User::factory($quantity)->create();
    }
}
