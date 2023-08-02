<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EventsRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the Events mat. view';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('REFRESH MATERIALIZED VIEW CONCURRENTLY events');
    }
}
