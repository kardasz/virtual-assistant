<?php

namespace App\Calendar\Domain\Repository;

use App\Calendar\Domain\Entity\Calendar;
use App\Shared\Domain\ValueObject\CalendarId;

interface CalendarRepositoryInterface
{
    public function findById(CalendarId $id): ?Calendar;

    public function persist(Calendar $Calendar): void;
}
