<?php

namespace EspressoByte\EventMessaging\Contracts;

interface EventInterface
{
    /**
     * @param $message
     */
    public function onReceived($message, $logger);

    /**
     * @param $message
     */
    public function onError($message, $logger);
}
