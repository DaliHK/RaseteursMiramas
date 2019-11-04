<?php

namespace App\Repository;

use App\Entity\ModeleDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ModeleDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeleDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeleDocument[]    findAll()
 * @method ModeleDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeleDocument::class);
    }

    // /**
    //  * @return ModeleDocument[] Returns an array of ModeleDocument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModeleDocument
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
