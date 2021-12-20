<?php

namespace EspressoByte\EventMessaging;

use Carbon\Carbon;
use EspressoByte\EventMessaging\Contracts\Broadcaster;
use Psr\Log\LoggerInterface;

class EventMessaging
{
    /**
     * @var mixed
     */
    protected $connection;

    /**
     * @var mixed
     */
    protected $logger;

    /**
     * @var mixed
     */
    protected $message;

    protected $timestamp;

    public function __construct(Broadcaster $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
        $this->timestamp = Carbon::now()->toDateTimeString();
    }

    public static function make(Broadcaster $connection, LoggerInterface $logger)
    {
        return new self($connection, $logger);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param $channel
     */
    public function publish($channel)
    {
        $this->connection->publish($channel, $this->getMessage());
    }

    public function getMessage()
    {
        return json_encode([
            'data'     => $this->message,
            'datetime' => $this->getEventTimeStamp(),
        ]);
    }

    public function getEventTimeStamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function logger()
    {
        return $this->logger;
    }
}
