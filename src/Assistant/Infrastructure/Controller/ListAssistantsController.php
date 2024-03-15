<?php

namespace App\Assistant\Infrastructure\Controller;

use App\Shared\Domain\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/api/assistant', name: 'api_assistant_list', methods: ['GET'])]
readonly class ListAssistantsController
{
    public function __construct(
        private QueryBusInterface $queryBus
    ) {
    }

    public function __invoke(Request $request, string $employeeId): Response
    {
        throw new \BadMethodCallException('Not implemented yet');
    }
}
