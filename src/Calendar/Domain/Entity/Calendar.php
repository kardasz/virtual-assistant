<?php

namespace App\Calendar\Domain\Entity;

use App\Calendar\Domain\Event\CalendarCreated;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\CalendarId;

class Calendar extends AggregateRoot
{
    public CalendarId $CalendarId;
    public string $title;

    public static function createNew(CalendarId $CalendarId): self
    {
        $user = new self();
        $user->recordThat(CalendarCreated::withData($CalendarId));

        return $user;
    }

    public function whenCalendarCreated(CalendarCreated $CalendarCreated): void
    {
        $this->CalendarId = $CalendarCreated->CalendarId;
    }
}
