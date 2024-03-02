<?php

declare(strict_types=1);

namespace App\Shared\Domain\Command;

interface AsyncCommandBusInterface
{
    public function dispatch(AsyncCommandInterface $command): void;
}
