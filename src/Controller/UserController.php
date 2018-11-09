<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
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
    public function insertdummy(UserRepository $userRep, UserPasswordEncoderInterface $passwordEncoder)
    {
        die("Comment this line to use...");

        for($i=0;$i<50;$i++){
            $user = new User();

            $password = $passwordEncoder->encodePassword($user, "test");
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $user->setEmail("user_d".$i."@gg.ff");
            $user->setUsername("user_d".$i."");

            $userRep->save($user);
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/setadmin", name="user_setadmin")
     */
    public function setAdmin(UserRepository $userRep)
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
