<?php

namespace Tests\Feature;

use App\Services\AuthService;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilingQuestionsTest extends TestCase
{

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

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function test_authenticated_user_can_get_profiling_questions()
    {
        unset($this->testUserData['password_confirmation']);
        $authService = resolve(AuthService::class);
        $user = $authService->registerNewUser($this->testUserData);

        $response = $this->actingAs($user, 'sanctum')
                           ->getJson(route('api.getProfilingQuestions'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'questions' => [
                '*' => [
                    'id',
                    'text',
                    'type',
                    'options',
                ]
            ]
        ]);
    }

    public function test_cant_get_profiling_questions_if_not_authenticated()
    {
        $response = $this->getJson(route('api.getProfilingQuestions'));
        $response->assertStatus(401);
        $response->assertJsonFragment(["message" => "Unauthenticated."]);
    }
}
