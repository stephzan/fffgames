<?php

namespace App\Repository;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

interface UserRepositoryInterface
{
    public function find(int $id);

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function exists(User $user);

    public function createNew(User $user, UserPasswordEncoderInterface $passwordEncoder);

    public function save(User $user);
}
