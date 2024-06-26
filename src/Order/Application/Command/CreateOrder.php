<?php

namespace App\Order\Application\Command;

use App\Shared\Domain\Command\CommandInterface;
use App\Shared\Domain\ValueObject\CustomerId;
use App\Shared\Domain\ValueObject\OrderId;

readonly class CreateOrder implements CommandInterface
{
    public function __construct(
        public OrderId $orderId,
        public CustomerId $orderingPartyId,
        public string $title,
        public string $description,
        public \DateTimeImmutable $expiresAt,
    ) {
    }
}
