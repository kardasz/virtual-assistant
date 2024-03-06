<?php

namespace App\Calendar\Application\QueryHandler;

use App\Calendar\Application\Query\FindCalendar;
use App\Calendar\Domain\Entity\Calendar;
use App\Calendar\Domain\Exception\CalendarNotFoundException;
use App\Calendar\Domain\Repository\CalendarRepositoryInterface;
use App\Shared\Domain\Query\QueryHandlerInterface;

readonly class FindCalendarQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private CalendarRepositoryInterface $calendarRepository
    ) {
    }

    public function __invoke(FindCalendar $query): Calendar
    {
        $result = $this->calendarRepository->findById($query->calendarId);
        if (null === $result) {
            throw new CalendarNotFoundException($query->calendarId);
        }

        return $result;
    }
}
