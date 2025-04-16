<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OrderCompleted implements ShouldQueue
{
    use Queueable;

    public function __construct(private array $data)
    {
    }

    public function handle(): void
    {
        var_dump($this->data);
    }
}
