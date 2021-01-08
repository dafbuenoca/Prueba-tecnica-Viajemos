<?php

namespace App\Controller;

use App\Repository\LibroRepository;
use App\Form\Type\LibroType;
use App\Entity\Libro;
use App\Entity\Editorial;
use App\Repository\EditorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/libros")
 */
class LibroController extends AbstractController
{
    /**
     * @Route("/", name="libros", methods={"GET"})
     */
    public function index(LibroRepository $libroRepository): Response
    {
        return $this->render('libro/index.html.twig', [
            'libros' => $libroRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="libro_new", methods={"GET","POST"})
     */
    public function new(Request $request):Response
    {

        $libro = new Libro();
        $entityManager = $this->getDoctrine()->getManager();
        $editoriales = array();

        $form = $this->createForm(LibroType::class, $libro);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
	        $entityManager->persist($libro);
	        $entityManager->flush();

	        return $this->redirectToRoute('libros');
	    }

        return $this->render('libro/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{id}", name="libro_show", methods={"GET"})
     */
    public function show(Libro $libro): Response
    {
        return $this->render('libro/show.html.twig', [
            'libro' => $libro,
        ]);
    }

}
