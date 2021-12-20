<?php

namespace EspressoByte\EventMessaging\Logger;

use EspressoByte\LoopUtil\FileLogger\Monolog\StreamHandler;
use Monolog\Logger;
use React\EventLoop\LoopInterface;
use React\Stream\WritableResourceStream;

class EventMessagingLogger
{
    /**
     * @var mixed
     */
    protected $logger;
    /**
     * @var mixed
     */
    protected $loopInterface;

    /**
     * @param LoopInterface $loopInterface
     */
    public function __construct(LoopInterface $loopInterface)
    {
        $this->logger = new Logger('event-messaging::laravel');
        $this->logger->pushHandler(new StreamHandler(new WritableResourceStream(STDOUT, $this->loopInterface)));

    }

    /**
     * @return mixed
     */
    public function logger()
    {
        return $this->logger;
    }

    /**
     * @return mixed
     */
    public function loop()
    {
        return $this->loopInterface;
    }
}
