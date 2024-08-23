<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function givePointToAuthenticatedUser(int $points): void
    {
        $transactionsRepository = resolve(TransactionRepository::class);
        $transactionsRepository->createTransaction(null, Auth::user()->id, $points);
    }
}
