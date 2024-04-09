<?php

namespace App\Order\Domain\Repository;

use App\Shared\Domain\ValueObject\OrderId;
use App\Order\Domain\Entity\Order;

interface OrderRepositoryInterface
{
    /**
     * @return Order[]
     */
    public function findByOrder(OrderId $employeeId): array;

    public function persist(Order $order): void;
}
