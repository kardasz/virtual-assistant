<?php

namespace App\Calendar\Infrastructure\Controller;

use App\Calendar\Application\Command\CreateCalendar;
use App\Calendar\Domain\Entity\Calendar;
use App\Shared\Domain\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/api/calendar', name: 'api_calendar_create', methods: ['POST'])]
class CreateCalendarController
{
    public function __construct(private CommandBusInterface $bus)
    {
    }

    public function __invoke(): Response
    {
        /** @var Calendar $Calendar */
        $calendar = $this->bus->dispatch(new CreateCalendar());

        return new JsonResponse(['id' => $calendar->calendarId], Response::HTTP_CREATED);
    }
}
