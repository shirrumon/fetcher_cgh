<?php

namespace App\Repository;

use App\Entity\PostEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostEntity>
 *
 * @method PostEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostEntity[]    findAll()
 * @method PostEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostEntity::class);
    }

    public function add(PostEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PostEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function deleteAllPosts(): void
    {
        $this->createQueryBuilder('p')
            ->delete()
            ->getQuery()
            ->execute();
    }
}
