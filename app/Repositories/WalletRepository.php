<?php

namespace App\Repositories;

use App\Interfaces\WalletRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Services\WalletService;
use Auth;
use Illuminate\Support\Facades\DB;

class WalletRepository implements WalletRepositoryInterface
{

    public function getUsersWallet(User $user, array $columns = ['*']): Wallet
    {
        return $user->wallet()->first($columns);
    }

    public function createUsersWallet(User $user, $balance = 0): void
    {
        $user->wallet()->create(['balance' => $balance]);
    }

    /**
     * @throws \Throwable
     */
    public function claimTransaction(int $transactionId):void
    {
        DB::transaction(function () use ($transactionId) {
            $transaction = Transaction::lockForUpdate()->whereId($transactionId)->first();
            $wallet = Wallet::lockForUpdate()->whereUserId($transaction->to)->first();
            $wallet->update(['balance' => $wallet->balance + WalletService::pointsToUSD($transaction->points)]);
            $transaction->update(['claimed' => true, 'claimed_at' => now()]);
        });
    }

}
