<?php

namespace App\Repositories;

use App\Interfaces\GlobalStatisticRepositoryInterface;
use App\Models\GlobalStatistic;

class GlobalStatisticRepository implements GlobalStatisticRepositoryInterface
{

    public function createGlobalStatistic(array $columns): GlobalStatistic
    {
        return GlobalStatistic::create($columns);
    }

}
