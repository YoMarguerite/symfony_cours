<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorie;
use App\Form\CategorieType;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index()
    {
        return $this->render('categorie/index.html.twig', [
        ]);
    }
    
     /**
     * @Route("/categorie/ajouter", name="categorie_ajouter")
     */
    public function ajouter(Request $request){

        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $categorie=$form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('categorie/ajouter.html.twig',[
            "form"=>$form->createView(),
            "Titre"=>"Nouvelle Catégorie"
        ]);
    }

    /**
     * @Route("/categorie/modifier/{id}", name="categorie_modifier")
     */
    
    public function modifier($id, Request $request)
    {
        //récupérer le repository (une connexion à la table en gros...)
        $repository= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repository->find($id);

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $categorie=$form->getData();

            //une connexion à la BDD par l'entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('categorie/ajouter.html.twig', [
            "form"=>$form->createView(),
            "Titre"=>"Modifier une catégorie"        
        ]);
    }

    /**
     * @Route("/categorie/verif/{id}", name="categorie_verif")
     */

    public function verif($id, Request $request)
    {
        //récupérer le repository (une connexion à la table en gros...)
        $repository= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repository->find($id);

        return $this->render('categorie/verification.html.twig', [
            "categorie"=>$categorie,
            "Titre"=>"Supprimer la catégorie"        
        ]);
    }

    /**
     * @Route("/categorie/supprimer/{id}", name="categorie_supprimer")
     */
    
    public function supprimer($id, Request $request)
    {
        //récupérer le repository (une connexion à la table en gros...)
        $repository= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repository->find($id);

        //une connexion à la BDD par l'entity manager
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        
        return $this->redirectToRoute("home");

    }

}