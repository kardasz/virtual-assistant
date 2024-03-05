<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use App\Shared\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    protected int $version = 0;

    /**
     * @var array<DomainEvent>
     */
    protected array $recordedEvents = [];

    protected function recordThat(DomainEvent $event): void
    {
        $this->recordedEvents[] = $event;

        $this->apply($event);
    }

    /**
     * @return DomainEvent[]
     */
    public function popEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }

    protected function apply(DomainEvent $event): void
    {
        $handler = 'when'.implode('', \array_slice(explode('\\', $event::class), -1));
        if (!method_exists($this, $handler)) {
            throw new \RuntimeException(sprintf('Missing event handler method %s for aggregate root %s', $handler, static::class));
        }

        $this->{$handler}($event);
    }
}
