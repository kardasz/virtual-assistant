<?php

namespace App\Assistant\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\ValueObject\AssistantId;

class AssistantCreated extends DomainEvent
{
    public readonly AssistantId $assistantId;
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $displayName;
    public readonly string $description;
    public readonly string $summary;

    public static function withData(
        AssistantId $assistantId,
    ): self {
        $event = new self((string) $assistantId);
        $event->assistantId = $assistantId;
        return $event;
    }

    public function getEventData(): array
    {
        return [
            'assistantId' => $this->assistantId,
        ];
    }
}
