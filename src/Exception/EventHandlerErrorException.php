<?php


namespace EspressoByte\EventMessaging\Exception;


class EventHandlerErrorException extends \Exception
{
        protected  $message = 'Error while processing handlers.';
}