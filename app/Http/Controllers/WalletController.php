<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function getWallet(WalletService $walletService): JsonResponse
    {
        try{
            $wallet = $walletService->getAuthUsersWalletWithTransactions();
            return response()->json(['wallet' => $wallet]);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
