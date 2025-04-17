<?php

namespace App\Console\Commands;

use App\Jobs\OrderCompleted;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OrderCompleted::dispatch([
            'order_id' => 1,
            'user_id' => 1,
            'total' => 100.00,
        ])->onQueue('emails_topic');
    }
}
