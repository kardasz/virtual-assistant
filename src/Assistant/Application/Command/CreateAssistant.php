<?php

namespace App\Assistant\Application\Command;

use App\Shared\Domain\Command\CommandInterface;
use App\Shared\Domain\ValueObject\AssistantId;
use App\Assistant\Domain\ValueObject\Country;

readonly class CreateAssistant implements CommandInterface
{
    public function __construct(
        public AssistantId $employeeId,
        public Country $country,
        public \DateTimeImmutable $start,
        public \DateTimeImmutable $end,
    ) {
    }
}
