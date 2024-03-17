<?php

namespace App\Assistant\Domain\Entity;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\AssistantId;
use App\Assistant\Domain\Event\AssistantCreated;

class Assistant extends AggregateRoot
{
    public readonly AssistantId $assistantId;
    public readonly string $firstName;
    public readonly string $lastName;
    
    public static function createNew(
        AssistantId $assistantId,
    ): self {
        $assistant = new self();
        $assistant->recordThat(AssistantCreated::withData(
            assistantId: $assistantId,
        ));

        return $assistant;
    }

    public function whenAssistantCreated(AssistantCreated $assistantCreated): void
    {
        $this->assistantId = $assistantCreated->assistantId;
    }
}
