<?php

namespace App\Assistant\Application\Query;

use App\Shared\Domain\Query\QueryInterface;
use App\Shared\Domain\ValueObject\AssistantId;

readonly class FindAssistant implements QueryInterface
{
    public function __construct(public AssistantId $employeeId)
    {
    }
}
