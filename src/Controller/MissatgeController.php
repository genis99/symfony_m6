<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Entity\Missatge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $canal = $repo_canal->find(5);


        $message = new Missatge();
        $message->setCanal($canal);
        $message->setText("Loool wtf?????");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($message);
        $entityManager->flush();

        return $this->render('missatge/index.html.twig', [
            'controller_name' => 'MissatgeController',
        ]);
    }
}
