<?php

namespace App\Services;

use App\Mail\SuccessfulTransactionClaimMail;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Auth;
use Illuminate\Support\Facades\Mail;

class WalletService
{

    public function getAuthUsersWalletWithTransactions(): array
    {
        $walletRepository = resolve(WalletRepository::class);
        $transactionsRepository = resolve(TransactionRepository::class);
        $user = Auth::user();

        return [
            'balance' => $walletRepository->getUsersWallet($user)->balance,
            'unclaimedTransactionsCount' => $transactionsRepository->getUnclaimedUserTransactions($user)->count(),
            'pendingBalance' => $transactionsRepository->getUsersPendingBalance($user),
        ];
    }

    public function getAuthUsersTransactions(): array
    {
        $transactionsRepository = resolve(TransactionRepository::class);
        $user = Auth::user();
        $columns = ['id', 'points', 'from', 'to', 'claimed'];
        return [
            'incoming' => $transactionsRepository->getIncomingUserTransactions($user, $columns),
            'outgoing' => $transactionsRepository->getOutgoingUserTransactions($user, $columns),
        ];
    }

    /**
     * @throws \Throwable
     */
    public function claimTransaction(int $transactionId): void
    {
        $walletRepository = resolve(WalletRepository::class);
        $walletRepository->claimTransaction($transactionId);
    }

    public function sendClaimedTransactionEmail(int $transactionId): void
    {
        $transactionRepository = resolve(TransactionRepository::class);
        $userRepository = resolve(UserRepository::class);
        $user = $userRepository->findUser(Auth::user()->id);

        $transaction = $transactionRepository->getTransactionById($transactionId);
        Mail::to($user)->send(new SuccessfulTransactionClaimMail($transaction->points));
    }

    public static function pointsToUSD(int $points):float
    {
        return round($points / 100, 2);
    }

}
