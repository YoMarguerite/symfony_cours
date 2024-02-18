<?php

namespace App\Repository;

use App\Entity\Aeroport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aeroport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aeroport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aeroport[]    findAll()
 * @method Aeroport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AeroportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aeroport::class);
    }

    // /**
    //  * @return Aeroport[] Returns an array of Aeroport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aeroport
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
