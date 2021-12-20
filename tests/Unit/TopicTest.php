<?php

namespace EspressoByte\EventMessaging\Tests\Unit;

use EspressoByte\EventMessaging\Tests\TestCase;
use EspressoByte\EventMessaging\Topic;

class TopicTest extends TestCase
{
    public function testItShouldReturnTopic()
    {
        $topic = new Topic('test:order.created');

        $this->assertInstanceOf(Topic::class, $topic);
        $this->assertEquals('test', $topic->group());
        $this->assertEquals('order.created', $topic->event());
        $this->assertIsString(strval('event.'.$topic));
        $this->assertEquals(strval($topic), 'event.'.$topic->event());
    }
}
