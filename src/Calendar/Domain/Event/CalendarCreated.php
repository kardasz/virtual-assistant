<?php

declare(strict_types=1);

namespace App\Calendar\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\ValueObject\CalendarId;

class CalendarCreated extends DomainEvent
{
    public readonly CalendarId $CalendarId;
    public readonly string $title;
    public string $time;
    public \DateTimeImmutable $createdAt;
    
    public static function withData(CalendarId $CalendarId): self
    {
        $event = new self((string) $CalendarId);
        $event->calendarId = $CalendarId;

        return $event;
    }

    public function getEventData(): array
    {
        return [
            'CalendarId' => $this->CalendarId,
        ];
    }
}
