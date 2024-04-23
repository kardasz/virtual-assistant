q<?php

namespace App\Order\Domain\Entity;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\CustomerId;
use App\Shared\Domain\ValueObject\OrderId;
use App\Order\Domain\Event\OrderCreated;

class Order extends AggregateRoot
{
    public readonly OrderId $orderId;
    public readonly CustomerId $orderingPartyId;
    public readonly string $description;
    public readonly \DateTimeImmutable $expiresAt;

    public static function createNew(
        OrderId $orderId,
        string $title,
        CustomerId $orderingPartyId,
        string $description,
        \DateTimeImmutable $expiresAt,
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
