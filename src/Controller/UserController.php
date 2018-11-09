<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\Preference;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/insertdummy", name="user_dummy")
     */
    public function insertdummy(UserService $userRep, UserPasswordEncoderInterface $passwordEncoder)
    {
        die('Comment this line to use...');

        for ($i = 3; $i < 50; ++$i) {
            $user = new User();

            $password = $passwordEncoder->encodePassword($user, 'test');
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $user->setEmail('user_d'.$i.'@gg.ff');
            $user->setUsername('user_d'.$i.'');
            $user->setOnline(0);

            $prof = new UserProfile();
            $prof->setLevel(1);
            $prof->setScore(0);

            $pref = new Preference();

            $user->setUserProfile($prof);
            $user->setPreference($pref);

            $userRep->save($user);
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/setadmin", name="user_setadmin")
     */
    public function setAdmin(UserService $userRep)
    {
        $u = new User();
        $user = $userRep->find(1);
        $user->setRoles(['ROLE_ADMIN']);
        $userRep->save($user);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
