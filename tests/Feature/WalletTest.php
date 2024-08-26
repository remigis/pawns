<?php

namespace Tests\Feature;

use App\Services\AuthService;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
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
    public function test_user_can_retrieve_wallet_info()
    {
        unset($this->testUserData['password_confirmation']);
        $authService = resolve(AuthService::class);
        $user = $authService->registerNewUser($this->testUserData);

        $response = $this->actingAs($user, 'sanctum')
                         ->getJson(route('api.getWallet'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'wallet' => [
                'balance',
                'unclaimedTransactionsCount',
                'pendingBalance',
            ]
        ]);
    }
}
