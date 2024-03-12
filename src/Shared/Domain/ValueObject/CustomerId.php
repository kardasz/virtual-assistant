<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Symfony\Component\Uid\Uuid;

class CustomerId extends Uuid implements \Stringable
{
    public static function generate(): self
    {
        return new self((string) self::v4());
    }
}
