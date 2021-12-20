<?php

namespace EspressoByte\EventMessaging\Connection;

use EspressoByte\EventMessaging\Listeners\DefaultListener;
use Monolog\Logger;
use React\EventLoop\LoopInterface;
use React\Stream\WritableResourceStream;
use SunValley\LoopUtil\FileLogger\Monolog\StreamHandler;

class BrokerConnection
{
    /**
     * @var mixed
     */
    protected $loopInterface;

    /**
     * @var mixed
     */
    protected $topic;

    /**
     * @var mixed
     */
    protected $output;

    /**
     * @param $topic
     */
    public function __construct($topic, LoopInterface $loopInterface)
    {
        $this->topic = $topic;
        $this->loopInterface = $loopInterface;
    }

    /**
     * @param $topic
     */
    public static function of($topic, LoopInterface $loopInterface)
    {
        return new self($topic, $loopInterface);
    }

    /**
     * @param $output
     *
     * @return mixed
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    public function connect()
    {
        $logger = new Logger('event-stream-laravel');
        $logger->pushHandler(new StreamHandler(new WritableResourceStream(STDOUT, $this->loopInterface)));

        $defaultListener = new DefaultListener($this->topic, $logger);

        $client = new \Laravie\Streaming\Client(
            ['host' => '127.0.0.1', 'port' => 6379], $this->loopInterface
        );

        $client->connect($defaultListener);
        $this->loopInterface->run();
    }

    /**
     * @return mixed
     */
    public function topic()
    {
        return $this->topic;
    }

    /**
     * @return mixed
     */
    public function loop()
    {
        return $this->loopInterface;
    }

    /**
     * @return mixed
     */
    public function output()
    {
        return $this->output;
    }
}
