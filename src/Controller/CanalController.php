<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CanalController extends AbstractController
{
    /**
     * @Route("/canal", name="canal")
     */
    public function index()
    {
        return $this->render('canal/index.html.twig', [
            'controller_name' => 'CanalController',
        ]);
    }
}
