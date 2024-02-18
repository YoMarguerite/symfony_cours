<?php

namespace App\Repository;

use App\Entity\AvionClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvionClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvionClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvionClasse[]    findAll()
 * @method AvionClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvionClasseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvionClasse::class);
    }

    // /**
    //  * @return AvionClasse[] Returns an array of AvionClasse objects
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
    public function findOneBySomeField($value): ?AvionClasse
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
