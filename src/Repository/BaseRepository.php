<?php

namespace App\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class BaseRepository
{
    /**
     * @var string
     * @var $entityManager    EntityManagerInterface
     * @var $objectRepository ObjectRepository
     */
    protected static $entity;
    protected $entityManager;
    protected $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(self::$entity);
    }

    public function save($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function count(array $criteria = []): int
    {
        return $this->objectRepository->count($criteria);
    }

    public function find(int $id)
    {
        return $this->objectRepository->find($id);
    }

    public function findAll()
    {
        return $this->objectRepository->findAll();
    }
}
