<?php

namespace App\Customer\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\ValueObject\CustomerId;

class CustomerCreated extends DomainEvent
{
    public readonly CustomerId $customerId;
    public readonly string $firstName;
    
    public static function withData(
        CustomerId $customerId,
    ): self {
        $event = new self((string) $customerId);
        $event->customerId = $customerId;
        return $event;
    }

    public function getEventData(): array
    {
        return [
            'customerId' => $this->customerId,
        ];
    }
}
