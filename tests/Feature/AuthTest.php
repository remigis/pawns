<?php

namespace Tests\Feature;

use App\Services\AuthService;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private array $testUserData;

    private Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->testUserData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }
    public function test_user_can_be_registered_successfully(): void
    {
        $response = $this->postJson(route('api.register'), $this->testUserData);
        $response->assertStatus(201)
                 ->assertJsonFragment(['message' => 'User successfully registered.']);
    }

    public function test_user_cant_register_with_same_email_twice()
    {
        $response = $this->postJson(route('api.register'), $this->testUserData);
        $response->assertStatus(201)
                 ->assertJsonFragment(['message' => 'User successfully registered.']);

        $response = $this->postJson(route('api.register'), $this->testUserData);
        $response->assertStatus(422)
                 ->assertJsonFragment(['email' => ['The email has already been taken.']]);
    }

    public function test_registration_fails_if_name_is_missing()
    {
        $data = $this->testUserData;
        unset($data['name']);

        $response = $this->postJson(route('api.register'), $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    public function test_registration_fails_if_email_is_missing()
    {
        $data = $this->testUserData;
        unset($data['email']);

        $response = $this->postJson(route('api.register'), $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('email');
    }

    public function test_registration_fails_if_password_is_missing()
    {
        $data = $this->testUserData;
        unset($data['password']);

        $response = $this->postJson(route('api.register'), $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('password');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function test_user_can_login()
    {
        unset($this->testUserData['password_confirmation']);
        $authService = resolve(AuthService::class);
        $authService->registerNewUser($this->testUserData);

        $response = $this->postJson(route('api.login'), [
            'email' => $this->testUserData['email'],
            'password' => $this->testUserData['password'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'User successfully logged in.']);
    }

    public function test_user_cant_login_with_bad_password()
    {
        unset($this->testUserData['password_confirmation']);
        $authService = resolve(AuthService::class);
        $authService->registerNewUser($this->testUserData);

        $response = $this->postJson(route('api.login'), [
            'email' => $this->testUserData['email'],
            'password' => 'bad-password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'The provided credentials are incorrect.']);
    }

    public function test_cant_register_using_proxy()
    {
        $response = $this->withServerVariables([
            'REMOTE_ADDR' => '77.73.69.59',
        ])->postJson(route('api.register'), $this->testUserData);

        $response->assertStatus(422);
        $response->assertJsonFragment(["message" => "You can't use proxy to register"]);
    }


}
