<?php

namespace App\Repository;

use App\Entity\Commentaries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaries>
 *
 * @method Commentaries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaries[]    findAll()
 * @method Commentaries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentariesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaries::class);
    }

    // CommentariesRepository.php

    public function findCommentariesByWords(array $words): array
    {
        $qb = $this->createQueryBuilder('c');

        // Créez une condition WHERE pour chaque mot spécifié
        foreach ($words as $key => $word) {
            $qb->orWhere('c.text LIKE :word_' . $key)
            ->setParameter('word_' . $key, '%' . $word . '%');
        }

        // Exécutez la requête et retournez les résultats
        return $qb->getQuery()->getResult();
    }


//    /**
//     * @return Commentaries[] Returns an array of Commentaries objects
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

//    public function findOneBySomeField($value): ?Commentaries
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
