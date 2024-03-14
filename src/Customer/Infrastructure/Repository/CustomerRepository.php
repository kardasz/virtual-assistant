<?php

namespace App\Customer\Infrastructure\Repository;

use App\Shared\Domain\ValueObject\CustomerId;
use App\Customer\Domain\Entity\Customer;
use App\Customer\Domain\Repository\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function persist(Customer $customer): void
    {
        $this->getEntityManager()->persist($customer);
        $this->getEntityManager()->flush();
    }

    /**
     * @return Customer[]
     */
    public function findByCustomer(CustomerId $customerId): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :id')
            ->setParameter('id', $customerId)
            ->getQuery()
            ->getResult();
    }
}
