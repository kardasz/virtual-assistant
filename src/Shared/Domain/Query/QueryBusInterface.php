<?php

declare(strict_types=1);

namespace App\Shared\Domain\Query;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $command): mixed;
}
