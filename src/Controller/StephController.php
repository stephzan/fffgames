<?php

namespace App\Controller;

use App\Entity\Steph;
use App\Form\StephType;
use App\Repository\StephRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/steph")
 */
class StephController extends AbstractController
{
    /**
     * @Route("/", name="steph_index", methods="GET")
     */
    public function index(StephRepository $stephRepository): Response
    {
        return $this->render('steph/index.html.twig', ['stephs' => $stephRepository->findAll()]);
    }

    /**
     * @Route("/new", name="steph_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $steph = new Steph();
        $form = $this->createForm(StephType::class, $steph);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($steph);
            $em->flush();

            return $this->redirectToRoute('steph_index');
        }

        return $this->render('steph/new.html.twig', [
            'steph' => $steph,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="steph_show", methods="GET")
     */
    public function show(Steph $steph): Response
    {
        return $this->render('steph/show.html.twig', ['steph' => $steph]);
    }

    /**
     * @Route("/{id}/edit", name="steph_edit", methods="GET|POST")
     */
    public function edit(Request $request, Steph $steph): Response
    {
        $form = $this->createForm(StephType::class, $steph);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('steph_index', ['id' => $steph->getId()]);
        }

        return $this->render('steph/edit.html.twig', [
            'steph' => $steph,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="steph_delete", methods="DELETE")
     */
    public function delete(Request $request, Steph $steph): Response
    {
        if ($this->isCsrfTokenValid('delete'.$steph->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($steph);
            $em->flush();
        }

        return $this->redirectToRoute('steph_index');
    }
}
