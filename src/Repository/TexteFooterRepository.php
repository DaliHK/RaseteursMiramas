<?php

namespace App\Repository;

use App\Entity\TexteFooter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TexteFooter|null find($id, $lockMode = null, $lockVersion = null)
 * @method TexteFooter|null findOneBy(array $criteria, array $orderBy = null)
 * @method TexteFooter[]    findAll()
 * @method TexteFooter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TexteFooterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TexteFooter::class);
    }

    // /**
    //  * @return TexteFooter[] Returns an array of TexteFooter objects
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
    public function findOneBySomeField($value): ?TexteFooter
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
