<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCompletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private Order $order) {}
}
