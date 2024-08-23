<?php

namespace App\Repositories;

use App\Interfaces\WalletRepositoryInterface;
use App\Models\User;
use App\Models\Wallet;

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

    public function addToUsersWallet(User $user, $amount)
    {
        // TODO: Implement addToUsersWallet() method.
    }

    public function removeFromUsersWallet(User $user, $amount)
    {
        // TODO: Implement removeFromUsersWallet() method.
    }

}
