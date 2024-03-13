<?php

namespace App\Customer\Domain\Repository;

use App\Shared\Domain\ValueObject\CustomerId;
use App\Customer\Domain\Entity\Customer;

interface CustomerRepositoryInterface
{
    /**
     * @return Customer[]
     */
    public function findByCustomer(CustomerId $employeeId): array;

    public function persist(Customer $customer): void;
}
