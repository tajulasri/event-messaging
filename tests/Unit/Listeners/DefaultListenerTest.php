<?php

namespace EspressoByte\EventMessaging\Tests\Unit\Listeners;

use EspressoByte\EventMessaging\EventPayload;
use EspressoByte\EventMessaging\Listeners\DefaultListener;
use EspressoByte\EventMessaging\Tests\TestCase;
use Mockery as m;

class DefaultListenerTest extends TestCase
{
    public function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function testItShouldSubscribeToRightTopic()
    {
        $topic = 'test';

        $listener = new DefaultListener($topic, app('log'));

        $this->assertInstanceOf(DefaultListener::class, $listener);
        $this->assertEquals($listener->subscribedChannels(), [$topic.':*']);

        $payload = new \StdClass();
        $payload->kind = 'topic_test';
        $payload->topic = 'test:*';
        $payload->channel = 'test:orders.created';
        $payload->payload = json_encode(['test' => 'data']);

        $eventPayload = new EventPayload($payload);

        $dispatchListener = $listener->onEmitted($eventPayload, null);

        $this->assertEquals([
            'EspressoByte\EventMessaging\EventHandlers\DefaultEventHandler' => 1,
        ], $dispatchListener);
    }
}
