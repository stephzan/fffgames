<?php

namespace App\Service;

use App\Entity\User;
use App\Helper\LoggerTrait;
use App\Repository\UserRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserService
{
    use LoggerTrait;

    private $repo;
    private $logger;

    public function __construct(UserRepositoryInterface $repo, LoggerInterface $logger)
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

    public function exists(User $user): bool
    {
        return $this->repo->exists($user);
    }

    public function save(User $user)
    {
        return $this->repo->save($user);
    }

    public function createNew(User $user, UserPasswordEncoderInterface $passwordEncoder)
    {
        return $this->repo->createNew($user, $passwordEncoder);
    }
}
