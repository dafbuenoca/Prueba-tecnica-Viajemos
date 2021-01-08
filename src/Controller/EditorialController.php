<?php

namespace App\Controller;

use App\Repository\EditorialRepository;
use App\Form\Type\EditorialType;
use App\Entity\Editorial;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/editoriales")
 */
class EditorialController extends AbstractController
{
    /**
     * @Route("/", name="editoriales", methods={"GET"})
     */
    public function index(EditorialRepository $editorialRepository): Response
    {
        return $this->render('editorial/index.html.twig', [
            'editoriales' => $editorialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="editorial_new", methods={"GET","POST"})
     */
    public function new(Request $request):Response
    {

        $editorial = new Editorial();

        $form = $this->createForm(EditorialType::class, $editorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
	        
            
	        $entityManager = $this->getDoctrine()->getManager();
	        $entityManager->persist($editorial);
	        $entityManager->flush();

	        return $this->redirectToRoute('editoriales');
	    }

        return $this->render('editorial/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
