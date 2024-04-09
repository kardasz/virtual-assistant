<?php

namespace App\Order\Infrastructure\Controller;

use App\Shared\Domain\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\OrderId;
use App\Order\Application\Command\CreateOrder;
use App\Order\Domain\Entity\Order;
use App\Order\Infrastructure\DTO\OrderDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
#[Route('/api/order', name: 'api_order_create', methods: ['POST'])]
class CreateOrderController
{
    public function __construct(
        private readonly CommandBusInterface $bus,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function __invoke(Request $request): Response
    {
        /** @var OrderDto $orderDto */
        $orderDto = $this->serializer->deserialize($request->getContent(), OrderDto::class, 'json');

        $errors = $this->validator->validate($orderDto);

        if (count($errors) > 0) {
            return new JsonResponse(
                [
                    'errors' => array_map(
                        fn (ConstraintViolationInterface $e) => ['property' => $e->getPropertyPath(), 'message' => $e->getMessage()],
                        iterator_to_array($errors)
                    ),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            /** @var Order $order */
            $order = $this->bus->dispatch(
                new CreateOrder(
                    orderId: OrderId::fromString($orderDto->orderId)
                )
            );

            return new JsonResponse(['id' => $order->orderId], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
