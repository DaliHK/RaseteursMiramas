<?php

namespace App\Repository;

use App\Entity\ParticipationEvenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ParticipationEvenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipationEvenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipationEvenement[]    findAll()
 * @method ParticipationEvenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationEvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipationEvenement::class);
    }

    // /**
    //  * @return ParticipationEvenement[] Returns an array of ParticipationEvenement objects
    //  */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    public function findOneBySomeField($value): ?ParticipationEvenement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
