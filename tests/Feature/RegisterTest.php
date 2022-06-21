<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testShouldRegisterWithValidData()
    {
        $name = $this->faker->name();
        $email = $this->faker->safeEmail();

        $response = $this->post('/register', [
            'name' => $name,
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '99991551120',
            'email' => $email,
            'document' => '66633392060',
        ]);

        $response->assertStatus(302)->assertRedirect(route('home'));
        $this->followRedirects($response)->assertSeeText(__('Dashboard'));

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);
    }

    /**
     * @dataProvider provideValidationInputsToRegisterCases
     */
    public function testValidationInputsToRegister($data, $expected_messages)
    {
        User::factory()->document('19980709057')->create();
        $response = $this->post('/register', $data);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(array_keys($data));

        $this->assertEquals($expected_messages, array_intersect_key(session('errors')->getMessages(), $expected_messages));
    }

    public function provideValidationInputsToRegisterCases()
    {
        $this->refreshApplication();

        return [
            'wrongMinLengthName' => [
                ['name' => Str::random(4)],
                ['name' => [__('The name must be at least 5 characters.')]],
            ],
            'wrongMaxLengthName' => [
                ['name' => Str::random(151)],
                ['name' => [__('The name must not be greater than 150 characters.')]],
            ],
            'wrongStringActingAsANumber' => [
                ['name' => 0000000000],
                ['name' => [__('The name must be a string.'), __('The name must be at least 5 characters.')]],
            ],

            'wrongDocument' => [
                ['document' => '02155211452'],
                ['document' => [__('CPF/CNPJ inválido')]],
            ],
            'wrongDocumentAsANumber' => [
                ['document' => 10347378056],
                ['document' => [__('The document must be a string.')]],
            ],
            'wrongDocumentNotUnique' => [
                ['document' => '19980709057'],
                ['document' => [__('The document has already been taken.')]],
            ],

            'wrongEmail' => [
                ['email' => 'wrongemail'],
                ['email' => [__('The email must be a valid email address.')]],
            ],
            'wrongEmailNotAString' => [
                ['email' => 32165411321],
                ['email' => [__('The email must be a string.'), __('The email must be a valid email address.')]],
            ],
            'wrongEmailMinLength' => [
                ['email' => 'e@e'],
                ['email' => [__('The email must be at least 5 characters.')]],
            ],
            'wrongEmailMaxLength' => [
                ['email' => Str::random(150) . '@' . Str::random(150)],
                ['email' => [__('The email must not be greater than 255 characters.')]],
            ],

            'wrongPhone' => [
                ['phone' => Str::random(8)],
                ['phone' => [__('The phone format is invalid.')]],
            ],
            'wrongPhoneNotAString' => [
                ['phone' => 99991635212],
                ['phone' => [__('The phone must be a string.')]],
            ],
        ];
    }
}
