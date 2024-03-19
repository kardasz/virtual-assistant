<?php

namespace App\Shared\Infrastructure\Doctrine\DBAL\Types;

use App\Shared\Domain\ValueObject\AssistantId;
use Symfony\Bridge\Doctrine\Types\AbstractUidType;

class OrderIdType extends AbstractUidType
{
    public const NAME = 'order_id';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getUidClass(): string
    {
        return AssistantId::class;
    }
}
