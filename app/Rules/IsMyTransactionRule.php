<?php

namespace App\Rules;

use App\Repositories\TransactionRepository;
use Auth;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsMyTransactionRule implements ValidationRule
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
        if($transaction && $transactionRepository->getTransactionReceiver($transaction)->id != Auth::user()->id)
        {
            $fail("You don't have a transaction with this id.");
        }
    }
}
