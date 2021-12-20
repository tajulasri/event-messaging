<?php

namespace EspressoByte\EventMessaging\Tests\Unit;

use EspressoByte\EventMessaging\EventPayload;
use EspressoByte\EventMessaging\Tests\TestCase;

class EventPayloadTest extends TestCase
{
    public function testItShouldReturnEventPayload()
    {
        $payload = new \StdClass();
        $payload->kind = 'topic_test';
        $payload->topic = 'test:*';
        $payload->channel = 'test:order.created';
        $payload->payload = \json_encode(['test' => 'data']);

        $eventPayload = new EventPayload($payload);

        $this->assertInstanceOf(EventPayload::class, $eventPayload);
        $this->assertEquals($payload->topic, $eventPayload->topic);
        $this->assertEquals($payload->channel, $eventPayload->channel);
        $this->assertEquals($payload->payload, $eventPayload->payload);
        $this->assertEquals($payload->kind, $eventPayload->kind);
        $this->assertIsString(strval($eventPayload));
        $this->assertEquals(\json_encode($payload), strval($eventPayload));
    }
}
