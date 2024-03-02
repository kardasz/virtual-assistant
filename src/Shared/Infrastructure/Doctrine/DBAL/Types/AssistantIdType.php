<?php

namespace App\Shared\Infrastructure\Doctrine\DBAL\Types;

use App\Shared\Domain\ValueObject\AssistantId;
use Symfony\Bridge\Doctrine\Types\AbstractUidType;

class AssistantIdType extends AbstractUidType
{
    public const NAME = 'assistant_id';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getUidClass(): string
    {
        return AssistantId::class;
    }
}
