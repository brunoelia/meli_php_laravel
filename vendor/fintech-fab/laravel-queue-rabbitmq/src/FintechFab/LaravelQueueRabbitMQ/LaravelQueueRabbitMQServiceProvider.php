<?php namespace FintechFab\LaravelQueueRabbitMQ;

use FintechFab\LaravelQueueRabbitMQ\Queue\Connectors\RabbitMQConnector;
use Illuminate\Support\ServiceProvider;

class LaravelQueueRabbitMQServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/rabbitmq.php', 'queue.connections.rabbitmq'
        );
    }

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * @var \Illuminate\Queue\QueueManager $manager
         */
        $manager = $this->app['queue'];

        $connector = new RabbitMQConnector;

        $manager->addConnector('rabbitmq', function () use ($connector) {
            return $connector;
        });

        $manager->stopping(function () use ($connector) {
            $connector->getConnection()->close();
        });

        $this->app->singleton('rabbitmq.connection', function ($app) use ($connector) {
            return $connector->getConnection();
        });
    }

}