<?php

namespace EspressoByte\EventMessaging;

class EventPayload
{
    /**
     * @var mixed
     */
    public $kind;
    /**
     * @var mixed
     */
    public $topic;
    /**
     * @var mixed
     */
    public $channel;
    /**
     * @var mixed
     */
    public $payload;

    /**
     * @param $payload
     */
    public function __construct($data)
    {
        $payload = $data;
        $this->kind = $payload->kind;
        $this->topic = $payload->topic;
        $this->channel = $payload->channel;
        $this->payload = $payload->payload;
    }

    /**
     * @param $attribute
     *
     * @return mixed
     */
    public function __get($attribute)
    {
        return $this->{$attribute};
    }

    public function __toString()
    {
        return \json_encode([
            'kind'    => $this->kind,
            'topic'   => $this->topic,
            'channel' => $this->channel,
            'payload' => $this->payload,
        ]);
    }
}
