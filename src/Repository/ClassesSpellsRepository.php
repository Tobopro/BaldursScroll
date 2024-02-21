<?php

namespace App\Repository;

use App\Entity\ClassesSpells;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassesSpells>
 *
 * @method ClassesSpells|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassesSpells|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassesSpells[]    findAll()
 * @method ClassesSpells[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassesSpellsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassesSpells::class);
    }

    /**
    * @return ClassesSpells[] Returns an array of ClassesSpells objects
    */
    public function getAllSpells($subClass, $level): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.idSubClasses = :subclass')
            ->andWhere('s.idLevel >= :level')
            ->setParameter('subclass', $subClass)
            ->setParameter('level', $level)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return ClassesSpells[] Returns an array of ClassesSpells objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClassesSpells
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
