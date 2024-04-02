<?php

namespace App\Order\Domain\Entity;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\OrderId;
use App\Order\Domain\Event\OrderCreated;

class Order extends AggregateRoot
{
    public readonly OrderId $orderId;
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $email;
    public readonly \DateTimeImmutable $expiresAt;
    
    public static function createNew(
        OrderId $orderId,
        string $title,
    ): self {
        $order = new self();
        $order->recordThat(OrderCreated::withData(
            orderId: $orderId,
            title: $title,
        ));

        return $order;
    }

    public function whenOrderCreated(OrderCreated $orderCreated): void
    {
        $this->orderId = $orderCreated->orderId;
    }
}
