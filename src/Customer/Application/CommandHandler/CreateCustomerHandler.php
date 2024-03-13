<?php

namespace App\Customer\Application\CommandHandler;

use App\Customer\Domain\Entity\Customer;
use App\Shared\Domain\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\CustomerId;
use App\Customer\Application\Command\CreateCustomer;
use App\Customer\Domain\Repository\CustomerRepositoryInterface;

readonly class CreateCustomerHandler implements CommandHandlerInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
    ) {
    }

    public function __invoke(CreateCustomer $command): Customer
    {
        $customer = Customer::createNew(
            customerId: CustomerId::generate(),
        );
        $this->customerRepository->persist($customer);

        return $customer;
    }
}
