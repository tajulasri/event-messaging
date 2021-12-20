<?php

namespace EspressoByte\EventMessaging\EventHandlers;

use EspressoByte\EventMessaging\Contracts\EventInterface;
use EspressoByte\EventMessaging\Exception\EventHandlerErrorException;

class DefaultEventHandler extends EventHandler implements EventInterface
{
    /**
     * @return mixed
     * @throws EventHandlerErrorException
     */
    public function onReceived($message, $logger)
    {
       $response = true;
       
       if(!$response) {
           throw new EventHandlerErrorException();
       }
       
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
