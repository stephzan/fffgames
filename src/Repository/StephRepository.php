<?php

namespace App\Repository;

use App\Entity\Steph;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Steph|null find($id, $lockMode = null, $lockVersion = null)
 * @method Steph|null findOneBy(array $criteria, array $orderBy = null)
 * @method Steph[]    findAll()
 * @method Steph[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StephRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Steph::class);
    }

    // /**
    //  * @return Steph[] Returns an array of Steph objects
    //  */
    /*
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
    */

    /*
    public function findOneBySomeField($value): ?Steph
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
