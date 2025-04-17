<?php

namespace App\Providers;

use App\Queue\Connectors\RabbitMQConnector;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class RabbitMQServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Aquí puedes registrar cualquier otro servicio necesario para RabbitMQ
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var QueueManager $queue */
        $queue = $this->app['queue'];

        $queue->addConnector('rabbitmq', function () {
            return new RabbitMQConnector($this->app);
        });
    }
}
