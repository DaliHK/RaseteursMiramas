<?php

namespace App\Repository;

use App\Entity\TexteAccueil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TexteAccueil|null find($id, $lockMode = null, $lockVersion = null)
 * @method TexteAccueil|null findOneBy(array $criteria, array $orderBy = null)
 * @method TexteAccueil[]    findAll()
 * @method TexteAccueil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TexteAccueilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TexteAccueil::class);
    }

    // /**
    //  * @return TexteAccueil[] Returns an array of TexteAccueil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TexteAccueil
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
