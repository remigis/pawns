<?php

namespace App\Interfaces;

use App\Models\GlobalStatistic;

interface GlobalStatisticRepositoryInterface
{
    public function createGlobalStatistic(array $columns): GlobalStatistic;
}
