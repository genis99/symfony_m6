<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Entity\Categoria;
use App\Form\CategoriaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria")
     */
    public function index()
    {
//        $repo_canal = $this->getDoctrine()->getRepository(Canal::class);
//        $canal = $repo_canal->find(7);
        $categoria = new Categoria();
//        $categoria->addCanal($canal);
        $categoria->setName("infantil");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($categoria);
        $entityManager->flush();
        return $this->render('categoria/index.html.twig', [
            'controller_name' => 'CategoriaController',
        ]);
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categories()
    {
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categories = $repository->findAll();
        return $this->render('categoria/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categoria/nou", name="nova_categoria", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoria);
            $entityManager->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->render('categoria/new.html.twig', [
            'categoria' => $categoria,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categoria/{id}", name="categoria_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categoria $categoria): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categoria);
        $em->flush();
        return $this->redirectToRoute('categories');
    }

//    TODO
//    /categories on es puguen borrar i afegir categories -> mostra totes les categories
//    a /canals botó de vincular amb una nova categoria, canviar o esborrar
//    Al fer afegir o cambiar que porti a una pàgina amb la id del canal que mostre les possibles categories a afegir
}
