<?php

namespace App\Rules;

use App\Repositories\TransactionRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TransactionNotClaimedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $transactionRepository = resolve(TransactionRepository::class);
        $transaction = $transactionRepository->getTransactionById($value);
        if(!$transaction) {
            $fail("Transaction not found");
        }else{
            if($transaction->claimed) {
                $fail("Transaction already claimed");
            }
        }


    }
}
