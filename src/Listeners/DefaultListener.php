<?php

namespace EspressoByte\EventMessaging\Listeners;

use EspressoByte\EventMessaging\EventManager;
use EspressoByte\EventMessaging\EventPayload;
use Laravie\Streaming\Listener as LaravieListener;

class DefaultListener extends Listener implements LaravieListener
{
    /**
     * @param $predis
     */
    public function onConnected($predis)
    {
        echo 'Connected to redis!'.PHP_EOL;
    }

    /**
     * @param $predis
     */
    public function onSubscribed($predis)
    {
        echo 'Subscribed to channel '.$this->getTopic();
    }

    /**
     * @param $event
     * @param $pubsub
     */
    public function onEmitted($event, $pubsub)
    {
        return EventManager::with(new EventPayload($event), $this->logger)->dispatch();
    }

    public function subscribedChannels(): array
    {
        return [$this->getTopic()];
    }
}
