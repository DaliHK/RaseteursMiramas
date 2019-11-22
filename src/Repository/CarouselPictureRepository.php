<?php

namespace App\Repository;

use App\Entity\CarouselPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CarouselPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarouselPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarouselPicture[]    findAll()
 * @method CarouselPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarouselPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarouselPicture::class);
    }

    // /**
    //  * @return CarouselPicture[] Returns an array of CarouselPicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarouselPicture
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
