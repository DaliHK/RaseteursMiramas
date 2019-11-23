<?php

namespace App\Repository;

use App\Entity\TexteFooterContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TexteFooterContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method TexteFooterContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method TexteFooterContact[]    findAll()
 * @method TexteFooterContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TexteFooterContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TexteFooterContact::class);
    }

    /**
    * @return TexteFooterContact[] Returns an array of TexteFooterContact objects
    *
    */
    
    public function findByAdresse($adresse)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.adresse = :val')
            ->setParameter('val', $adresse)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?TexteFooterContact
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
