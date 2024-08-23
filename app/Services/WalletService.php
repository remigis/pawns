<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use Auth;

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
}
