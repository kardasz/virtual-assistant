<?php

namespace App\Shared\Infrastructure\Command;

use App\Shared\Domain\Command\AsyncCommandBusInterface;
use App\Shared\Domain\Command\AsyncCommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerAsyncCommandBus implements AsyncCommandBusInterface
{
    public function __construct(
        private MessageBusInterface $commandBusAsync
    ) {
    }

    public function dispatch(AsyncCommandInterface $command): void
    {
        $this->commandBusAsync->dispatch($command);
    }
}
