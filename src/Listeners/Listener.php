<?php

namespace EspressoByte\EventMessaging\Listeners;

use Psr\Log\LoggerInterface;

abstract class Listener
{
    /**
     * @var mixed
     */
    protected $topic;

    /**
     * @var mixed
     */
    protected $logger;

    /**
     * @param $topic
     */
    public function __construct($topic, LoggerInterface $logger)
    {
        $this->topic = $topic;
        $this->logger = $logger;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic.':*';
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getTopic();
    }
}
