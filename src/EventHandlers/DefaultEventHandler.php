<?php

namespace EspressoByte\EventMessaging\EventHandlers;

use EspressoByte\EventMessaging\Contracts\EventInterface;

class DefaultEventHandler extends EventHandler implements EventInterface
{
    /**
     * @return mixed
     */
    public function onReceived($message, $logger)
    {
        $logger->info('testing');

        return 1;
    }

    /**
     * @return mixed
     */
    public function onError($message, $logger)
    {
        return 'error on event handler => '.\get_class($this);
    }
}
