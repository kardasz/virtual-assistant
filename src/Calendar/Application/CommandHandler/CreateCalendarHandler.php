<?php

namespace App\Calendar\Application\CommandHandler;

use App\Calendar\Application\Command\CreateCalendar;
use App\Calendar\Domain\Entity\Calendar;
use App\Calendar\Domain\Repository\CalendarRepositoryInterface;
use App\Shared\Domain\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\CalendarId;

class CreateCalendarHandler implements CommandHandlerInterface
{
    public function __construct(
        private CalendarRepositoryInterface $calendarRepository
    ) {
    }

    public function __invoke(CreateCalendar $command)
    {
        $calendar = Calendar::createNew(CalendarId::generate());

        // Domain events ?
        $this->calendarRepository->persist($calendar);

        return $calendar;
    }
}
