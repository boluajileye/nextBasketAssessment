<?php

namespace App\Services;

use App\Jobs\LogUserNotifyJob;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class NotifyService implements NotifyServiceInterface
{

    /**
     * Connection property
     * @var AMQPStreamConnection
     */
    protected AMQPStreamConnection $connection;

    /**
     * Channel property
     * @var
     */
    public $channel;

    /**
     * Application queue name
     * @var string
     */
    public String $queueName;

    public function __construct()
    {
        info("Starting");
        $this->queueName = config('messaging.queue_name');
        $this->connection = new AMQPStreamConnection(
            config('messaging.rabbitmq_host'),
            config('messaging.rabbitmq_port'),
            config('messaging.rabbitmq_user'),
            config('messaging.rabbitmq_password'));
        $this->channel = $this->connection->channel();
        $this->declareQueue();
    }

    /**
     * Process User information in Message Queue
     */
    public function handle(): void {
        $this->channel->basic_consume($this->queueName, '', false, true, false, false, $this->callback());

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    /**
     * Get channel value
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    public function channel() {
        return $this->connection->channel();
    }

    /**
     * declare queue configuration
     * @return void
     */
    public function declareQueue() {
        $this->channel->queue_declare($this->queueName, false, false, false, false);
    }

    /**
     * Get queued data from queue
     * @return callable
     */
    public function callback() {
        return function ($message) {
            $userData = unserialize($message->body);

            LogUserNotifyJob::dispatch($userData->toArray());

            info("Job dispatched");
        };
    }

    /**
     * Class deconstructor  to close queue connections
     */
    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
        info("Ending");
    }
}

?>
