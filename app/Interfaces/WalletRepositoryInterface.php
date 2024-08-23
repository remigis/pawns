<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function getUsersWallet(User $user, array $columns):Wallet;

    public function createUsersWallet(User $user, $balance = 0);

    public function addToUsersWallet(User $user, $amount);
    public function removeFromUsersWallet(User $user, $amount);


}
