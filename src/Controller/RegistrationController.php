<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
//use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserService $userRep)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Check if exists
            if (!$userRep->exists($user)) {
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
                $user->setRoles(['ROLE_USER']);

                // 4) save the User!
                $userRep->save($user);

                $this->addFlash(
                    'notice',
                    'Registration complete!'
                );

                return $this->redirectToRoute('home');
            } else {
                return $this->render(
                    'registration/register.html.twig',
                    ['page_title' => 'Registration',
                          'form' => $form->createView(),
                          'error' => 'User exists', ]
                );
            }
        }

        return $this->render(
            'registration/register.html.twig',
            ['page_title' => 'Registration',
                  'form' => $form->createView(),
                  'error' => '', ]
        );
    }
}
