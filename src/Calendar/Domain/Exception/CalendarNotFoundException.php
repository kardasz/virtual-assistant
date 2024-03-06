<?php

namespace App\Calendar\Domain\Exception;

use App\Shared\Domain\ValueObject\CalendarId;

class CalendarNotFoundException extends \Exception
{
    public function __construct(
        public readonly CalendarId $calendarId,
        \Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                'Calendar "%s" not found',
                $this->calendarId
            ),
            previous: $previous
        );
    }
}
