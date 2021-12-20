<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    'redis'  => [
        'host' => '127.0.0.1',
        'port' => 6789,
    ],
    //map fired event to each handlers
    'events' => [
        'orders.created' => [
            \EspressoByte\EventMessaging\EventHandlers\DefaultEventHandler::class,
        ],
    ],
];
