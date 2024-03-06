<?php

namespace App\Calendar\Application\Query;

use App\Shared\Domain\Query\QueryInterface;
use App\Shared\Domain\ValueObject\CalendarId;

readonly class FindCalendar implements QueryInterface
{
    public function __construct(public CalendarId $calendarId)
    {
    }
}
