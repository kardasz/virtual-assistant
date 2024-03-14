<?php

namespace App\Customer\Infrastructure\Controller;

use App\Shared\Domain\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\CustomerId;
use App\Customer\Application\Command\CreateCustomer;
use App\Customer\Domain\Entity\Customer;
use App\Customer\Infrastructure\DTO\CustomerDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
#[Route('/api/customer', name: 'api_customer_create', methods: ['POST'])]
class CreateCustomerController
{
    public function __construct(
        private readonly CommandBusInterface $bus,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function __invoke(Request $request): Response
    {
        /** @var CustomerDto $customerDto */
        $customerDto = $this->serializer->deserialize($request->getContent(), CustomerDto::class, 'json');

        $errors = $this->validator->validate($customerDto);

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
            /** @var Customer $customer */
            $customer = $this->bus->dispatch(
                new CreateCustomer(
                    customerId: CustomerId::fromString($customerDto->customerId)
                )
            );

            return new JsonResponse(['id' => $customer->customerId], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
