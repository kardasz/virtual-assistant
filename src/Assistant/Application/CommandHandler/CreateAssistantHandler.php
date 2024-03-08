<?php

namespace App\Assistant\Application\CommandHandler;

use App\Assistant\Domain\Entity\Assistant;
use App\Shared\Domain\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\AssistantId;
use App\Assistant\Application\Command\CreateAssistant;
use App\Assistant\Domain\Repository\AssistantRepositoryInterface;

readonly class CreateAssistantHandler implements CommandHandlerInterface
{
    public function __construct(
        private AssistantRepositoryInterface $assistantRepository,
    ) {
    }

    public function __invoke(CreateAssistant $command): Assistant
    {
        $assistant = Assistant::createNew(
            assistantId: AssistantId::generate(),
        );
        $this->assistantRepository->persist($assistant);

        return $assistant;
    }
}
