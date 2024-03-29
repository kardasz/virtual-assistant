<?php

namespace App\Order\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\ValueObject\OrderId;

class OrderCreated extends DomainEvent
{
    public readonly OrderId $orderId;
    public readonly string $title;

    public static function withData(
        OrderId $orderId,
        string $title,
    ): self {
        $event = new self((string) $orderId);
        $event->orderId = $orderId;
        $event->title = $title;
        return $event;
    }

    public function getEventData(): array
    {
        return [
            'orderId' => $this->orderId,
            'title' => $this->title,
        ];
    }
}
