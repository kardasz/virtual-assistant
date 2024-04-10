<?php

namespace App\Order\Application\CommandHandler;

use App\Order\Domain\Entity\Order;
use App\Shared\Domain\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\OrderId;
use App\Order\Application\Command\CreateOrder;
use App\Order\Domain\Repository\OrderRepositoryInterface;

readonly class CreateOrderHandler implements CommandHandlerInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function __invoke(CreateOrder $command): Order
    {
        $order = Order::createNew(
            orderId: OrderId::generate(),
            title: $command->title,
        );
        $this->orderRepository->persist($order);

        return $order;
    }
}
