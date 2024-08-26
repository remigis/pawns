<?php

namespace App\Console\Commands;

use App\Repositories\GlobalStatisticRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Console\Command;

class StoreDailyStatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:store-daily-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and Store Daily Global Statistics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $globalStatisticsRepository = resolve(GlobalStatisticRepository::class);
        $transactionRepository = resolve(TransactionRepository::class);

        $globalStatistics = $transactionRepository->getTransactionsDailyStatsArray();
        $globalStatisticsRepository->createGlobalStatistic($globalStatistics);
    }
}
