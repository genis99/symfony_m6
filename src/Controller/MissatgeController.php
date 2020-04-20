<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Entity\Missatge;
use App\Form\MissatgeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MissatgeController extends AbstractController
{
    /**
     * @Route("/missatge", name="missatge")
     */
//    public function index()
//    {
//        return $this->render('missatge/index.html.twig', [
//            'controller_name' => 'MissatgeController',
//        ]);
//    }

    public function createMissatge()
    {
        $repo_canal = $this->getDoctrine()->getRepository(Canal::class);
        $canal = $repo_canal->find(10);


        $message = new Missatge();
        $message->setCanal($canal);
        $message->setText("Loool wtf?????");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($message);
        $entityManager->flush();

        return $this->redirectToRoute('canals');
    }

    /**
     * @Route("{id_canal}/missatge/nou", name="missatge_nou", methods={"GET","POST"})
     */
    public function new(Request $request, $id_canal): Response
    {
        $missatge = new Missatge();
        $repo_canal = $this->getDoctrine()->getRepository(Canal::class);
        $canal = $repo_canal->find($id_canal);
        $missatge->setCanal($canal);
        $form = $this->createForm(MissatgeType::class, $missatge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($missatge);
            $entityManager->flush();
            return $this->redirectToRoute('canals');
        }
//        var_dump($canal->getId());

        return $this->render('missatge/new.html.twig', [
            'text' => $missatge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("missatge/{id}/edit", name="missatge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Missatge $missatge): Response
    {
        $form = $this->createForm(MissatgeType::class, $missatge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('canals');
        }

        return $this->render('missatge/edit.html.twig', [
            'text' => $missatge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/missatge/{id}", name="missatge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Missatge $missatge): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($missatge);
        $em->flush();
        return $this->redirectToRoute('canals');
    }
}
