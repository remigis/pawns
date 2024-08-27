<?php

namespace Tests\Feature;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use App\Services\WalletService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class TransactionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->testUserData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
        ];
        $this->testUserData2 = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
        ];
    }

    /**
     * A basic feature test example.
     */
    public function test_transaction_can_be_claimed(): void
    {
        $userRepository = resolve(UserRepository::class);
        $transactionRepository = resolve(TransactionRepository::class);
        $walletRepository = resolve(WalletRepository::class);
        $user = $userRepository->createUser($this->testUserData);
        $wallet = $walletRepository->createUsersWallet($user);
        $transaction = $transactionRepository->createTransaction(null, $user->id, 5);

        $response = $this->actingAs($user, 'sanctum')
                         ->postJson(route('api.claimTransaction'), ['id' => $transaction->id]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Transaction claimed']);
    }

    public function test_transaction_cant_be_claimed_if_not_receiver(): void
    {
        $userRepository = resolve(UserRepository::class);
        $transactionRepository = resolve(TransactionRepository::class);
        $walletRepository = resolve(WalletRepository::class);
        $user = $userRepository->createUser($this->testUserData);
        $user2 = $userRepository->createUser($this->testUserData2);
        $wallet = $walletRepository->createUsersWallet($user);
        $wallet2 = $walletRepository->createUsersWallet($user2);
        $transaction = $transactionRepository->createTransaction(null, $user->id, 5);

        $response = $this->actingAs($user2, 'sanctum')
                         ->postJson(route('api.claimTransaction'), ['id' => $transaction->id]);

        $response->assertStatus(422);
        $response->assertJson([
            "message" => "Validation failed",
            "errors" => [
                "id" => [
                    0 => "You don't have a transaction with this id."
                ]
            ]
        ]);
    }

    public function test_racing_claim_request_fails(): void
    {
        $points = 5;
        $userRepository = resolve(UserRepository::class);
        $transactionRepository = resolve(TransactionRepository::class);
        $walletRepository = resolve(WalletRepository::class);
        $user = $userRepository->createUser($this->testUserData);
        $wallet = $walletRepository->createUsersWallet($user);
        $transaction = $transactionRepository->createTransaction(null, $user->id, $points);

        $response1 = $this->actingAs($user, 'sanctum')
                         ->postJson(route('api.claimTransaction'), ['id' => $transaction->id]);

        $response2 = $this->actingAs($user, 'sanctum')
                         ->postJson(route('api.claimTransaction'), ['id' => $transaction->id]);

        $response1->assertStatus(200);
        $response1->assertJson(['message' => 'Transaction claimed']);
        $wallet->refresh();
        assertEquals(WalletService::pointsToUSD($points), $wallet->balance);
        $response2->assertStatus(422);
        $response2->assertJson([
            "errors" => [
                "id" => [
                    0 => "Transaction already claimed"
                ]
            ]
        ]);
    }
}
