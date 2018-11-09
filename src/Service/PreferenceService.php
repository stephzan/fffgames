<?php

namespace App\Service;

use App\Entity\Preference;
use App\Helper\LoggerTrait;
use App\Repository\PreferenceInterface;
use Psr\Log\LoggerInterface;

final class PreferenceService
{
    use LoggerTrait;

    private $repo;
    private $logger;

    public function __construct(PreferenceInterface $repo, LoggerInterface $logger)
    {
        $this->repo = $repo;
        $this->logger = $logger;
    }

    public function find(int $id): Preference
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

    public function save(Preference $Preference)
    {
        return $this->repo->save($Preference);
    }
}
