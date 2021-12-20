<?php

namespace EspressoByte\EventMessaging\Contracts;

interface Broadcaster
{
    public function connection();

    public function publish($channel, $message);
}
