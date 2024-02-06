<?php

namespace App\Repository;

use App\Entity\SubClasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubClasses>
 *
 * @method SubClasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubClasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubClasses[]    findAll()
 * @method SubClasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubClassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubClasses::class);
    }

//    /**
//     * @return SubClasses[] Returns an array of SubClasses objects
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

//    public function findOneBySomeField($value): ?SubClasses
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
