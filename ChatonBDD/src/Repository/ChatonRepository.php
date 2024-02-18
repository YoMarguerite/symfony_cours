<?php

namespace App\Repository;

use App\Entity\Chaton;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Chaton|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chaton|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chaton[]    findAll()
 * @method Chaton[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chaton::class);
    }

    // /**
    //  * @return Chaton[] Returns an array of Chaton objects
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
    public function findOneBySomeField($value): ?Chaton
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
