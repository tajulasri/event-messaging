<?php

namespace EspressoByte\EventMessaging\Broadcaster;

use EspressoByte\EventMessaging\Contracts\Broadcaster;
use Illuminate\Redis\RedisManager;

class RedisBroadcaster implements Broadcaster
{
    /**
     * @var mixed
     */
    protected $connection;
    /**
     * @var mixed
     */
    protected $redisManager;
    /**
     * @var mixed
     */
    protected $channel;
    /**
     * @var mixed
     */
    protected $message;

    public function __construct(RedisManager $redisManager)
    {
        $this->redisManager = $redisManager;
        $this->connection = $this->redisManager->connection();
    }

    /**
     * @return mixed
     */
    public function connection()
    {
        return $this->connection == null ? null : $this->connection;
    }

    /**
     * @param $channel
     * @param $message
     */
    public function publish($channel, $message)
    {
        $this->message = $message;
        $this->channel = $channel;

        $this->connection()->client()->publish($this->getBroadcastedChannel(), $this->getBroadcastsMessage());
    }

    /**
     * @return mixed
     */
    public function getBroadcastsMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getBroadcastedChannel()
    {
        return $this->channel;
    }

    /**
     * @return mixed
     */
    public function manager(): RedisManager
    {
        return $this->redisManager;
    }
}
