<?php

declare(strict_types=1);

namespace App\Calendar\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\ValueObject\CalendarId;

class CalendarCreated extends DomainEvent
{
    public readonly CalendarId $CalendarId;

    public static function withData(CalendarId $CalendarId): self
    {
        $event = new self((string) $CalendarId);
        $event->CalendarId = $CalendarId;

        return $event;
    }

    public function getEventData(): array
    {
        return [
            'CalendarId' => $this->CalendarId,
        ];
    }
}
