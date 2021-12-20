[![test](https://github.com/tajulasri/event-messaging/actions/workflows/testing.yml/badge.svg)](https://github.com/tajulasri/event-messaging/actions/workflows/testing.yml)

# Very short description of the package

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash

    composer require espresso-byte/event-messaging

```

## Usage

```php

    //call artisan command for broker be able to start
    //this codebase is using wrapped around async redis provided by laravie/streaming package and event loop by React PHP
    php artisan eventmessaging:broker:serve event.*

```

```php
//publish message

    EspressoByte\EventMessaging\EventMessaging::message(['user_id' => 1,'ordered_items' => []])
        ->publish('orders.created');

```

## Usage

```php
//create handlers to handle events

use EspressoByte\EventMessaging\Contracts\EventInterface;

class OrderCreatedHandler implements EventInterface
{
     /**
     * @return mixed
     */
    public function onReceived($message, $logger)
    {
        $logger->info('orders created.');
        
        //just return any response
        return 'orders.created';
    }

    /**
     * @return mixed
     */
    public function onError($message, $logger)
    {   
        //handle the exception during handlers processing
        return 'error on event handler => '.\get_class($this);
    }
}

```

```php

//event handlers registry -> config/event-messaging.php

'events' => [
        'orders.created' => [
            OrderCreatedHandler::class,
        ]

```


### Testing

```bash

composer test

```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mtajulasri@gmail.com instead of using the issue tracker.

## Credits

-   [Tajul Asri](https://github.com/tajulasri)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
