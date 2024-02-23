<?php

namespace App\Services;

use PhpAmqpLib\Message\AMQPMessage;
use App\Services\MessagingServiceInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Models\User;

class MessagingService implements MessagingServiceInterface
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
    protected $channel;

    /**
     * Application queue name property
     * @var string
     */
    protected String $queueName;

    /**
     * Inserted User Property
     * @var User
     */
    protected  User $user;

    public function __construct(User $user)
    {
        info("Starting");
        $this->user = $user;
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

        $data = serialize($this->user);

        info($data);

        $message = new AMQPMessage($data);

        $this->channel->basic_publish($message, '', $this->queueName);

    }

    public function channel() {
        return $this->connection->channel();
    }

    public function declareQueue() {
        $this->channel->queue_declare($this->queueName, false, false, false, false);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
        info("Ending");
    }
}

?>
