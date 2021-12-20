<?php

namespace EspressoByte\EventMessaging\Console;

use EspressoByte\EventMessaging\Connection\BrokerConnection;
use Illuminate\Console\Command;
use React\EventLoop\LoopInterface;

class StartBrokerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventmessaging:broker:serve {topic}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Broker Server to manage event streams.';

    public function handle()
    {
        BrokerConnection::of($this->argument('topic'), app(LoopInterface::class))
            ->setOutput($this->output)
            ->connect();
    }
}
