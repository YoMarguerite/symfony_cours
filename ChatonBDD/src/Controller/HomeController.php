<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);

        $lesCategories = $repository->findAll();

        return $this->render('categorie/index.html.twig', [

            'lesCategories' => $lesCategories
        ]);
    }
}
