<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\Preference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

//use Doctrine\ORM\EntityManagerInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function exists(User $user)
    {
        $e = $this->findOneBy(['email' => $user->getEmail()]);

        return (!empty($e)) ? true : false;
    }

    public function createNew(User $user, UserPasswordEncoderInterface $passwordEncoder)
    {
        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setRoles(['ROLE_USER']);
        $user->setOnline(0);

        $prof = new UserProfile();
        $prof->setLevel(1);
        $prof->setScore(0);

        $pref = new Preference();

        $user->setUserProfile($prof);
        $user->setPreference($pref);

        return $this->save($user);
    }

    public function save(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}
