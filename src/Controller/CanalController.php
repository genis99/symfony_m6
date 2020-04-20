<?php

namespace App\Controller;

use App\Entity\Canal;
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
//        $entityManager = $this->getDoctrine()->getManager();
        $canals = $repository->findAll();
        return $this->render('canal/index.html.twig', [
            'canals' => $canals,
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
