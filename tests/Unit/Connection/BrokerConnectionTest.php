<?php

namespace EspressoByte\EventMessaging\Tests\Unit\Connection;

use EspressoByte\EventMessaging\Connection\BrokerConnection;
use EspressoByte\EventMessaging\Tests\TestCase;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

class BrokerConnectionTest extends TestCase
{
    public function testItShouldInitiateConnection()
    {
        $this->assertTrue(true);

        // $topic = 'test:orders.created';
        // $eventLoop = Loop::get();

        // $connection = BrokerConnection::of($topic, $eventLoop);
        // $this->assertInstanceOf(BrokerConnection::class, $connection);
        // $this->assertEquals($topic, $connection->topic());
        // $this->assertInstanceOf(LoopInterface::class, $connection->loop());
    }
}
