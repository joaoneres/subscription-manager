<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testShouldAccessProfilePage()
    {
        $response = $this->actingAs($user = $this->user())->get('/profile');

        $response
            ->assertStatus(200);
    }

    public function testShouldSeePageSections()
    {
        $response = $this->actingAs($user = $this->user())->get('/profile');

        $response
            ->assertStatus(200)
            ->assertSeeText(__('Profile'))
            ->assertSeeText($user->name)
            ->assertSeeText(__('Basic Data'))
            ->assertSeeText(__('Avatar'))
            ->assertDontSeeText('Verify your email');
    }

    public function testShouldSeeVerifyEmailSectionWhenNoEmailValidation()
    {
        $response = $this->actingAs($user = User::factory()->unverifiedEmail()->create())->get('/profile');

        $response
            ->assertStatus(200)
            ->assertSeeText(__('Verify your email'));
    }

    public function testShouldBeUnauthorizedToUpdateADifferentProfileSimpleData()
    {
        $user_for_testing = $this->user();
        $response = $this->actingAs($this->user())->post('/profile/' . $user_for_testing->id . '/simple-data', []);

        $response
            ->assertStatus(403)
            ->assertSeeText('403')
            ->assertSeeText(__('This action is unauthorized'));
    }

    public function testShouldBeUnauthorizedToUpdateADifferentProfileAvatar()
    {
        Storage::fake('local');
        $user_for_testing = $this->user();

        $response = $this->actingAs($this->user())->post('/profile/' . $user_for_testing->id . '/avatar', [
            'image' => UploadedFile::fake()->create('image.png'),
        ]);

        $response
            ->assertStatus(403)
            ->assertSeeText('403')
            ->assertSeeText(__('This action is unauthorized'));
    }

    public function testShouldUpdateSimpleDataWithValidInputs()
    {
        $response = $this->actingAs($user = $this->user())->post('/profile/' . $user->id . '/simple-data', [
            'name' => $this->faker->name(),
            'phone' => '999' . (String) $this->faker->numberBetween(90000000, 99999999),
            'document' => '79220380030',
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('status', __('Profile has been updated successfully!'));
    }

    public function testShouldUpdateAvatarWithValidFile()
    {
        Storage::fake('local');

        $response = $this->actingAs($user = $this->user())->post('/profile/' . $user->id . '/avatar', [
            'image' => UploadedFile::fake()->create('image.png'),
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('status', __(':name has been updated successfully!', ['name' => 'Avatar']));
    }

     /**
     * @dataProvider provideValidationInputsToUpdateBasicDataCases
     */
    public function testValidationInputsToPutAction($data, $expected_messages)
    {
        User::factory()->document('19980709057')->create();
        $response = $this->actingAs($user = User::factory()->document('30565169009')->create())->post('/profile/' . $user->id . '/simple-data', $data);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(array_keys($data));

        $this->assertEquals($expected_messages, session('errors')->getMessages());
    }

    public function provideValidationInputsToUpdateBasicDataCases()
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
                ['name' => [__('The name must be at least 5 characters.'), __('The name must be a string.')]],
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
