<?php

namespace App\Assistant\Application\Command;

use App\Shared\Domain\Command\CommandInterface;
use App\Shared\Domain\ValueObject\AssistantId;

readonly class CreateAssistant implements CommandInterface
{
    public function __construct(
        public AssistantId $assistantId,
    ) {
    }
}
