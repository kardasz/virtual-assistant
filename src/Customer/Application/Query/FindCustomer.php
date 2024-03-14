<?php

namespace App\Customer\Application\Query;

use App\Shared\Domain\Query\QueryInterface;
use App\Shared\Domain\ValueObject\CustomerId;

readonly class FindCustomer implements QueryInterface
{
    public function __construct(public CustomerId $employeeId)
    {
    }
}
