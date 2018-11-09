<?php

namespace App\Service;

use App\Entity\UserProfile;
use App\Helper\LoggerTrait;
use App\Repository\UserProfileRepositoryInterface;
use Psr\Log\LoggerInterface;

final class UserProfileService
{
    use LoggerTrait;

    private $repo;
    private $logger;

    public function __construct(UserProfileRepositoryInterface $repo, LoggerInterface $logger)
    {
        $this->repo = $repo;
        $this->logger = $logger;
    }

    public function find(int $id): User
    {
        return $this->repo->find($id);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repo->findBy($criteria, $orderBy = null, $limit = null, $offset = null);
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->repo->findOneBy($criteria, $orderBy = null);
    }

    public function exists(UserProfile $UserProfile): bool
    {
        return $this->repo->exists($UserProfile);
    }

    public function save(UserProfile $UserProfile)
    {
        return $this->repo->save($UserProfile);
    }
}
