<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Form\CanalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CanalController extends AbstractController
{
    /**
     * @Route("/canals", name="canals")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Canal::class);
        $canals = $repository->findAll();
        return $this->render('canal/index.html.twig', [
            'canals' => $canals,
        ]);
    }
    /**
     * @Route("/info", name="info")
     */
    public function info()
    {
        return $this->render('canal/info.html.twig');
    }

    /**
     * @Route("/canal/nou", name="canal_nou", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $canal = new Canal();
        $form = $this->createForm(CanalType::class, $canal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($canal);
            $entityManager->flush();

            return $this->redirectToRoute('canals');
        }

        return $this->render('canal/new.html.twig', [
            'canal' => $canal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/canal/{id}", name="canal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Canal $canal): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($canal);
        $em->flush();
        return $this->redirectToRoute('canals');
    }

    /**
     * @Route("/{id}/edit", name="canal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Canal $canal): Response
    {
        $form = $this->createForm(CanalType::class, $canal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('canals');
        }

        return $this->render('canal/edit.html.twig', [
            'canal' => $canal,
            'form' => $form->createView(),
        ]);
    }

//    public function createCanal(): Response
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $canal = new Canal();
//        $canal->setName('Canal Prova');
//
//        $entityManager->persist($canal);
//        $entityManager->flush();
//        return $this->render('canal/index.html.twig', [
//            'controller_name' => 'CanalController',
//        ]);
//    }
}
