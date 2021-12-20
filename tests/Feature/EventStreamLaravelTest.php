<?php

namespace EspressoByte\EventMessaging\Tests\Feature;

use EspressoByte\EventMessaging\Broadcaster\RedisBroadcaster;
use EspressoByte\EventMessaging\EventMessaging;
use EspressoByte\EventMessaging\Tests\TestCase;
use Illuminate\Redis\RedisManager;
use Psr\Log\LoggerInterface;

class EventStreamLaravelTest extends TestCase
{
    public function testPublishNewEvent()
    {
        $broadcaster = new RedisBroadcaster(app(RedisManager::class));
        $payload = [
            'test' => ['test' => 'test'],
        ];

        $stream = EventMessaging::make($broadcaster, app(LoggerInterface::class));
        $publishing = $stream->payload($payload)->publish('orders.created');

        $eventPayload = [
            'data'     => $payload,
            'datetime' => $stream->getEventTimeStamp(),
       ];

        $this->assertInstanceOf(EventMessaging::class, $stream);
        $this->assertEquals($stream->getPayload(), json_encode($eventPayload));
    }
}
