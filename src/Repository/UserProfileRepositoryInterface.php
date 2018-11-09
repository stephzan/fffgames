<?php

namespace App\Repository;

use App\Entity\UserProfile;

interface UserProfileRepositoryInterface
{
    public function find(int $id);

    public function findOneBy(array $criteria, array $orderBy = null);

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function save(UserProfile $userProfile);
}
