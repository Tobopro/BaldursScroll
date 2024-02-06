<?php

namespace App\Repository;

use App\Entity\StartingHp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StartingHp>
 *
 * @method StartingHp|null find($id, $lockMode = null, $lockVersion = null)
 * @method StartingHp|null findOneBy(array $criteria, array $orderBy = null)
 * @method StartingHp[]    findAll()
 * @method StartingHp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StartingHpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StartingHp::class);
    }

//    /**
//     * @return StartingHp[] Returns an array of StartingHp objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StartingHp
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
