<?php

namespace App\Customer\Domain\Entity;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\CustomerId;
use App\Customer\Domain\Event\CustomerCreated;

class Customer extends AggregateRoot
{
    public readonly CustomerId $customerId;
    public readonly string $firstName;
    public readonly string $lastName;
    
    public static function createNew(
        CustomerId $customerId,
    ): self {
        $customer = new self();
        $customer->recordThat(CustomerCreated::withData(
            customerId: $customerId,
        ));

        return $customer;
    }

    public function whenCustomerCreated(CustomerCreated $customerCreated): void
    {
        $this->customerId = $customerCreated->customerId;
    }
}
