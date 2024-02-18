<?php

namespace App\Repository;

use App\Entity\TarifVol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TarifVol|null find($id, $lockMode = null, $lockVersion = null)
 * @method TarifVol|null findOneBy(array $criteria, array $orderBy = null)
 * @method TarifVol[]    findAll()
 * @method TarifVol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarifVolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TarifVol::class);
    }

    // /**
    //  * @return TarifVol[] Returns an array of TarifVol objects
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
    public function findOneBySomeField($value): ?TarifVol
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
