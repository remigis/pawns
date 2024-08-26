<?php

use App\Console\Commands\StoreDailyStatisticsCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();*/

\Illuminate\Support\Facades\Schedule::command(StoreDailyStatisticsCommand::class)->dailyAt('00:00');
