<?php

namespace App\Repository;

use App\Entity\RacesSpells;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RacesSpells>
 *
 * @method RacesSpells|null find($id, $lockMode = null, $lockVersion = null)
 * @method RacesSpells|null findOneBy(array $criteria, array $orderBy = null)
 * @method RacesSpells[]    findAll()
 * @method RacesSpells[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RacesSpellsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RacesSpells::class);
    }

//    /**
//     * @return RacesSpells[] Returns an array of RacesSpells objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RacesSpells
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
