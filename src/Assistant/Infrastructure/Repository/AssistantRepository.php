<?php

namespace App\Assistant\Infrastructure\Repository;

use App\Shared\Domain\ValueObject\AssistantId;
use App\Assistant\Domain\Entity\Assistant;
use App\Assistant\Domain\Repository\AssistantRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assistant>
 *
 * @method Assistant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assistant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assistant[]    findAll()
 * @method Assistant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssistantRepository extends ServiceEntityRepository implements AssistantRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assistant::class);
    }

    public function persist(Assistant $assistant): void
    {
        $this->getEntityManager()->persist($assistant);
        $this->getEntityManager()->flush();
    }

    /**
     * @return Assistant[]
     */
    public function findByAssistant(AssistantId $assistantId): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :id')
            ->setParameter('id', $assistantId)
            ->getQuery()
            ->getResult();
    }
}
