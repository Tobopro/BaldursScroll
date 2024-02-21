<?php

namespace App\Repository;

use App\Entity\RacesSpells;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    
    public function findSpellsByRace(int $characterId): array
    {
        return $this->createQueryBuilder('rs')
            ->select('s')
            ->join('rs.idSpell', 's')
            ->join('rs.idSubRace', 'subRace')
            ->join('subRace.idRace', 'race') // Assurez-vous que 'idRace' est correct
            ->join('rs.idLevel', 'level') // Assurez-vous que 'idLevel' est correct
            ->join('rs.idSubRace', 'characterSubRace') // Assurez-vous que 'idSubRace' est correct
            ->join('characterSubRace.characters', 'character', Join::WITH, 'character.id = :characterId')
            ->setParameter('characterId', $characterId)
            ->getQuery()
            ->getResult();
    }

    /**
    * @return RacesSpells[] Returns an array of RacesSpells objects
    */
    public function getAllSpells($subRace, $level): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.idSubRace = :subrace')
            ->andWhere('s.idLevel >= :level')
            ->setParameter('subrace', $subRace)
            ->setParameter('level', $level)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
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
