<?php

namespace App\Repository;

use App\Entity\SourcePhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SourcePhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourcePhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourcePhoto[]    findAll()
 * @method SourcePhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourcePhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourcePhoto::class);
    }

    // /**
    //  * @return SourcePhoto[] Returns an array of SourcePhoto objects
    //  */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findOneBySomeField($value): ?SourcePhoto
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
