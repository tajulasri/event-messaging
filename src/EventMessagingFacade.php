<?php

namespace EspressoByte\EventMessaging;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EspressoByte\EventMessaging\Skeleton\SkeletonClass
 */
class EventMessagingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'smsniaga.eventstream';
    }
}
