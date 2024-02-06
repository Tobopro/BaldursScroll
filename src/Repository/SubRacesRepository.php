<?php

namespace App\Repository;

use App\Entity\SubRaces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubRaces>
 *
 * @method SubRaces|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubRaces|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubRaces[]    findAll()
 * @method SubRaces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubRacesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubRaces::class);
    }

//    /**
//     * @return SubRaces[] Returns an array of SubRaces objects
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

//    public function findOneBySomeField($value): ?SubRaces
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
