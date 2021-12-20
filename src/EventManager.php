<?php

namespace EspressoByte\EventMessaging;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\ForwardsCalls;
use Psr\Log\LoggerInterface;

class EventManager
{
    use ForwardsCalls;

    /**
     * @var mixed
     */
    protected $eventPayload;

    /**
     * @var array
     */
    protected $response = [];

    /**
     * @var mixed
     */
    protected $logger;

    /**
     * @param EventPayload    $eventPayload
     * @param LoggerInterface $logger
     */
    public function __construct(EventPayload $eventPayload, LoggerInterface $logger)
    {
        $this->eventPayload = $eventPayload;
        $this->logger = $logger;
    }

    /**
     * @param EventPayload    $eventPayload
     * @param LoggerInterface $logger
     */
    public static function with(EventPayload $eventPayload, LoggerInterface $logger): self
    {
        return new self($eventPayload, $logger);
    }

    /**
     * @return mixed
     */
    public function dispatch(): array
    {
        //dispatch to subscribed events
        $this->getEventHandlers()->each(function ($instance) {
            $this->response[$instance] = app($instance)->onReceived($this->eventPayload->payload, $this->logger);
        });

        return $this->response;
    }

    protected function getEventHandlers(): Collection
    {
        $topic = new Topic($this->eventPayload->channel);
        $eventHandlers = config('event-stream-laravel.events');

        return array_key_exists($topic->event(), $eventHandlers) ? new Collection($eventHandlers[$topic->event()]) : new Collection();
    }
}
