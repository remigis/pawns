<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{

    public function getIncomingUserTransactions(User $user, array $columns = ['*']):Collection;
    public function getOutgoingUserTransactions(User $user, array $columns = ['*']):Collection;
    public function getAllUserTransactions(User $user, array $columns = ['*']):Collection;
    public function getUnclaimedUserTransactions(User $user, array $columns = ['*']): Collection;
}
