<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @dataProvider provideTestShouldReturnErrorToPostAttempt
     */
    public function testShouldReturnErrorToPostAttempt($response)
    {
        $response
            ->assertStatus(405)
            ->assertSeeText('405')
            ->assertSeeText(__('Method not allowed'));
    }

    public function provideTestShouldReturnErrorToPostAttempt()
    {
        $this->refreshApplication();

        return [
            'whenAdministrator' => [$this->actingAs($this->user(true))->post('/users')],
            'whenNonAdministrator' => [$this->actingAs($this->user())->post('/users')],
        ];
    }

    /**
     * @dataProvider provideTestShouldBeUnauthorizedWhenUserIsntAdministratorCases
     */
    public function testShouldBeUnauthorizedWhenUserIsntAdministrator($response)
    {
        $response
            ->assertStatus(403)
            ->assertSeeText('403')
            ->assertSeeText(__('This action is unauthorized'));
    }

    public function provideTestShouldBeUnauthorizedWhenUserIsntAdministratorCases()
    {
        $this->refreshApplication();
        $user = $this->user();

        return [
            'unableToGetUsers' => [$this->actingAs($user)->get('/users')],
            'unableToSeeUsers' => [$this->actingAs($user)->get('/users/' . $user->id)],
            'unableToPutUsers' => [$this->actingAs($user)->put('/users/' . $user->id)],
            'unableToDeleteUsers' => [$this->actingAs($user)->delete('/users/' . $user->id)],
        ];
    }

    public function testShouldSeeTableContentOnIndexPage()
    {
        $user = $this->user(true);

        $response = $this->actingAs($user)->get('/users');

        $response
            ->assertStatus(200)
            ->assertSeeText(__('Users'))
            ->assertSeeText(__('ID'))
            ->assertSeeText(__('Name'))
            ->assertSeeText(__('Phone'))
            ->assertSeeText(__('Actions'))
            ->assertSeeText($user->name)
            ->assertSeeText($user->email)
            ->assertSeeText($user->phone)
            ->assertSeeText(__('See'))
            ->assertSeeText(__('Edit'))
            ->assertSeeText(__('Delete'));
    }

    public function testShouldSeeContentOnSeePage()
    {
        $user = $this->user(true);

        $response = $this->actingAs($user)->get('/users/' . $user->id);

        $response
            ->assertStatus(200)
            ->assertSeeText(__('ID'))
            ->assertSeeText(__('Name'))
            ->assertSeeText(__('Phone'))
            ->assertSeeText(__('Document'))
            ->assertSeeText(__('Is Admin'))
            ->assertSeeText(__('Created at'))
            ->assertSeeText($user->name)
            ->assertSeeText($user->email)
            ->assertSeeText($user->phone)
            ->assertSeeText($user->document)
            ->assertSeeText($user->is_admin ? __('Yes') : __('No'))
            ->assertSeeText($user->created_at->diffForHumans(now()))
            ->assertSeeText(__('Back'));
    }

    public function testShouldEditUser()
    {
        $user = $this->user(true);
        $created_user = $this->user();
        $name = $this->faker->name();

        $response = $this->actingAs($user)->put('/users/' . $created_user->id, [
            'name' => $name,
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('status', __($name . ' was updated successfully!'));
    }

    public function testShouldDeleteUser()
    {
        $user = $this->user(true);
        $created_user = $this->user();

        $response = $this->actingAs($user)->delete('/users/' . $created_user->id);

        $response
            ->assertStatus(302)
            ->assertSessionHas('status', __($created_user->name . ' was deleted successfully!'));
    }

    /**
     * @dataProvider provideValidationInputsToPutActionCases
     */
    public function testValidationInputsToPutAction($data, $expected_messages)
    {
        $user = User::factory()->admin()->document('30565169009')->create();
        $created_user = User::factory()->admin()->document('19980709057')->create();

        $response = $this->actingAs($user)->put('/users/' . $created_user->id, $data);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(array_keys($data));

        $this->assertEquals($expected_messages, session('errors')->getMessages());
    }

    public function provideValidationInputsToPutActionCases()
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
                ['document' => '30565169009'],
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

            'wrongIsAdmin' => [
                ['is_admin' => Str::random(1)],
                ['is_admin' => [__('The is admin field must be true or false.')]],
            ],
        ];
    }
}
