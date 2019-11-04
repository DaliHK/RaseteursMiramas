<?php

namespace App\Repository;

use App\Entity\TextePresentationEcole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TextePresentationEcole|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextePresentationEcole|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextePresentationEcole[]    findAll()
 * @method TextePresentationEcole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextePresentationEcoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextePresentationEcole::class);
    }

    // /**
    //  * @return TextePresentationEcole[] Returns an array of TextePresentationEcole objects
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
    public function findOneBySomeField($value): ?TextePresentationEcole
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
