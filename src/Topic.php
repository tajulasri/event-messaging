<?php

namespace EspressoByte\EventMessaging;

use Illuminate\Support\Str;

class Topic
{
    /**
     * @var mixed
     */
    protected $channel;

    /**
     * @param $payload
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    public function group()
    {
        return Str::before($this->channel, ':');
    }

    public function event()
    {
        return Str::after($this->channel, ':');
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->event();
    }
}
