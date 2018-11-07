<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function find(int $id);

    public function exists(User $user);

    public function save(User $user);
}
