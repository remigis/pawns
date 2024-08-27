<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use App\Services\WalletService;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function createTransaction($from, $to, $points): Transaction
    {
        return Transaction::create([
            'from' => $from,
            'to' => $to,
            'points' => $points,
        ]);
    }

    public function getTransactionById(int $id): null|Transaction
    {
        return Transaction::find($id);
    }

    public function getIncomingUserTransactions(User $user, array $columns = ['*']): Collection
    {
        return Transaction::whereTo($user->id)->get($columns);
    }

    public function getOutgoingUserTransactions(User $user, array $columns = ['*']): Collection
    {
        return Transaction::whereFrom($user->id)->get($columns);
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

    public function getTransactionReceiver(Transaction $transaction): User
    {
        return User::whereId($transaction->to)->first();
    }

    public function getTransactionsDailyStatsArray(): array
    {
        $transactionsCreatedToday = Transaction::whereDate('created_at', today())->count();
        $transactionsClaimedToday = Transaction::whereDate('claimed_at', today())->count();
        $pointsClaimedToday = Transaction::whereDate('claimed_at', today())->sum('points');
        $usdClaimedToday = WalletService::pointsToUSD($pointsClaimedToday);

        return [
            'date' => now()->format('Y-m-d'),
            'created_transactions' => $transactionsCreatedToday,
            'claimed_transactions' => $transactionsClaimedToday,
            'claimed_usd' => $usdClaimedToday,
        ];
    }

}
