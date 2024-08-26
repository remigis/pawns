<?php

use App\Http\Controllers\ProfilingQuestionController;
use App\Http\Controllers\WalletController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get_wallet', [WalletController::class, 'getWallet'])->name('api.getWallet');
    Route::get('/get_transactions', [WalletController::class, 'getTransactions'])->name('api.getTransactions');
    Route::post('/claim_transaction', [WalletController::class, 'claimTransaction'])->name('api.claimTransaction');
});
