<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    'subscribed_topic'  => 'event.',

    'redis'  => [
        'host' => '127.0.0.1',
        'port' => 6789,
    ],

    'events' => [
        'orders.created' => [
            \EspressoByte\EventMessaging\EventHandlers\DefaultEventHandler::class,
        ],
    ],
];
