<?php

namespace App\Repository;

use App\Entity\UserProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserProfile[]    findAll()
 * @method UserProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserProfileRepository extends ServiceEntityRepository implements UserProfileRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserProfile::class);
    }

    public function save(UserProfile $UserProfile): void
    {
        $this->_em->persist($UserProfile);
        $this->_em->flush();
    }
}
