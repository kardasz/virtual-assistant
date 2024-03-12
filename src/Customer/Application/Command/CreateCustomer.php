<?php

namespace App\Customer\Application\Command;

use App\Shared\Domain\Command\CommandInterface;
use App\Shared\Domain\ValueObject\CustomerId;

readonly class CreateCustomer implements CommandInterface
{
    public function __construct(
        public CustomerId $customerId,
    ) {
    }
}
