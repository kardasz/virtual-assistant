<?php

namespace App\Order\Application\Query;

use App\Shared\Domain\Query\QueryInterface;
use App\Shared\Domain\ValueObject\OrderId;

readonly class FindOrder implements QueryInterface
{
    public function __construct(public OrderId $employeeId)
    {
    }
}
