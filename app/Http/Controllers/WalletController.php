<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\ClaimTransactionRequest;
use App\Services\WalletService;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function getWallet(WalletService $walletService): JsonResponse
    {
        try{
            $wallet = $walletService->getAuthUsersWalletWithTransactions();
            return response()->json(['wallet' => $wallet]);
        }catch (Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function getTransactions(WalletService  $walletService): JsonResponse
    {
        try{
            $transactions = $walletService->getAuthUsersTransactions();
            return response()->json(['transactions' => $transactions]);
        }catch (Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function claimTransaction(ClaimTransactionRequest $request, WalletService $walletService): JsonResponse
    {
        try{
            $walletService->claimTransaction($request->id);
            $walletService->sendClaimedTransactionEmail($request->id);
            return response()->json(['message' => 'Transaction claimed']);
        }catch (Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
