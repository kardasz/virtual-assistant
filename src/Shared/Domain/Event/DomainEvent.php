<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use Symfony\Component\Uid\Uuid;

abstract class DomainEvent
{
    public readonly string $eventId;
    public readonly \DateTimeImmutable $occurredOn;

    public function __construct(
        public readonly string $aggregateId,
        string $eventId = null,
        \DateTimeImmutable $occurredOn = null,
    ) {
        $this->eventId = $eventId ?? (string) Uuid::v4();
        $this->occurredOn = $occurredOn ?? new \DateTimeImmutable();
    }
}
