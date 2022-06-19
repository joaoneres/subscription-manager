<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function user(Bool $is_admin = false)
    {
        return $is_admin ? User::factory()->admin()->create() : User::factory()->create();
    }
}
