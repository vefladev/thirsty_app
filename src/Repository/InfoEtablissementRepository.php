<?php

namespace App\Repository;

use App\Entity\InfoEtablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoEtablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoEtablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoEtablissement[]    findAll()
 * @method InfoEtablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoEtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoEtablissement::class);
    }

    // /**
    //  * @return InfoEtablissement[] Returns an array of InfoEtablissement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoEtablissement
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
