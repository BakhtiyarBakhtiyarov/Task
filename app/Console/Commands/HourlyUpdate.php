<?php

namespace App\Console\Commands;

use App\Models\Data;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete 30 days old records each hour';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Data::where('created_at', '<', Carbon::now())->each(function ($data) {
            $data->delete();
        });
    }
}
