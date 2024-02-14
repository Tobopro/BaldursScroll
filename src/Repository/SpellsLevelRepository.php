<?php

namespace App\Repository;

use App\Entity\SpellsLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SpellsLevel>
 *
 * @method SpellsLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpellsLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpellsLevel[]    findAll()
 * @method SpellsLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpellsLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpellsLevel::class);
    }

//    /**
//     * @return SpellsLevel[] Returns an array of SpellsLevel objects
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

//    public function findOneBySomeField($value): ?SpellsLevel
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
