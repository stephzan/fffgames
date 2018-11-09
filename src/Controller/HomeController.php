<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserService $userRep)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $player = $this->getUser();
        $player->setOnline(true);
        $userRep->save($player);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'player' => $player
        ]);
    }
}
