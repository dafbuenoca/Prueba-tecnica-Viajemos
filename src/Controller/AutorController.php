<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Form\Type\AutorType;
use App\Repository\AutorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/autores")
 */
class AutorController extends AbstractController
{
    /**
     * @Route("/", name="autor_index", methods={"GET"})
     */
    public function index(AutorRepository $autorRepository): Response
    {
        return $this->render('autor/index.html.twig', [
            'autores' => $autorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="autor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $autor = new Autor();
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($autor);
            $entityManager->flush();

            return $this->redirectToRoute('autor_index');
        }

        return $this->render('autor/new.html.twig', [
            'autor' => $autor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autor_show", methods={"GET"})
     */
    public function show(Autor $autor): Response
    {
        return $this->render('autor/show.html.twig', [
            'autor' => $autor,
        ]);
    }


}