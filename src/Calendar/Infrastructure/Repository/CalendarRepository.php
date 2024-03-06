<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure\Repository;

use App\Calendar\Domain\Entity\Calendar;
use App\Calendar\Domain\Repository\CalendarRepositoryInterface;
use App\Shared\Domain\ValueObject\CalendarId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Calendar>
 *
 * @method Calendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendar[]    findAll()
 * @method Calendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarRepository extends ServiceEntityRepository implements CalendarRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendar::class);
    }

    public function persist(Calendar $Calendar): void
    {
        $this->getEntityManager()->persist($Calendar);
        $this->getEntityManager()->flush();
    }

    public function findById(CalendarId $id): ?Calendar
    {
        return $this->find($id);
    }
}
