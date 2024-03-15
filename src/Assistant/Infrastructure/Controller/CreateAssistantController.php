<?php

namespace App\Assistant\Infrastructure\Controller;

use App\Shared\Domain\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\AssistantId;
use App\Assistant\Application\Command\CreateAssistant;
use App\Assistant\Domain\Entity\Assistant;
use App\Assistant\Domain\ValueObject\Country;
use App\Assistant\Infrastructure\DTO\AssistantDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
#[Route('/api/assistant', name: 'api_assistant_create', methods: ['POST'])]
class CreateAssistantController
{
    public function __construct(
        private readonly CommandBusInterface $bus,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function __invoke(Request $request): Response
    {
        /** @var AssistantDto $assistantDto */
        $assistantDto = $this->serializer->deserialize($request->getContent(), AssistantDto::class, 'json');

        $errors = $this->validator->validate($assistantDto);

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
            /** @var Assistant $assistant */
            $assistant = $this->bus->dispatch(
                new CreateAssistant(
                    assistantId: AssistantId::fromString($assistantDto->assistantId)
                )
            );

            return new JsonResponse(['id' => $assistant->assistantId], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
