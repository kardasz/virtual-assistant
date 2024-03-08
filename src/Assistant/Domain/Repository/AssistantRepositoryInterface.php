<?php

namespace App\Assistant\Domain\Repository;

use App\Shared\Domain\ValueObject\AssistantId;
use App\Assistant\Domain\Entity\Assistant;

interface AssistantRepositoryInterface
{
    /**
     * @return Assistant[]
     */
    public function findByAssistant(AssistantId $employeeId): array;

    public function persist(Assistant $assistant): void;
}
