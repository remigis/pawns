<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function createTransaction($from, $to, $points): void
    {
        Transaction::create([
            'from' => $from,
            'to' => $to,
            'points' => $points,
        ]);
    }

    public function getIncomingUserTransactions(User $user, array $columns = ['*']): Collection
    {
        return Transaction::whereFrom($user->id)->get($columns);
    }

    public function getOutgoingUserTransactions(User $user, array $columns = ['*']): Collection
    {
        return Transaction::whereTo($user->id)->get($columns);
    }

    public function getAllUserTransactions(User $user, array $columns = ['*']): Collection
    {
        return Transaction::where('from', $user->id)->orWhere('to', $user->id)->get($columns);
    }

    public function getUnclaimedUserTransactions(User $user, array $columns = ['*']): Collection
    {
        return Transaction::whereTo($user->id)->where('claimed', false)->get($columns);
    }

    public function getUsersPendingBalance(User $user): float
    {
        $points = $this->getUnclaimedUserTransactions($user)->sum('points');
        return round($points / 100, 2);
    }

}
