<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Proprietaire;
use App\Form\ProprietaireType;

class ProprietaireController extends AbstractController
{
    /**
     * @Route("/proprietaire", name="proprietaire")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Proprietaire::class);

        $lesProprietaires = $repository->findAll();

        return $this->render('proprietaire/index.html.twig', [
            'Titre' => "Les Propriétaires",
            'proprietaires' => $lesProprietaires
        ]);
    }

    /**
     * @Route("/proprietaire/chatons/{id}", name="proprietaire_chatons")
     */
    public function chatons($id)
    {
        $repository= $this->getDoctrine()->getRepository(Proprietaire::class);
        $proprietaire = $repository->find($id);

        return $this->render('proprietaire/chatons.html.twig', [
            'proprietaire' => $proprietaire
        ]);
    }

    /**
     * @Route("/proprietaire/ajouter", name="proprietaire_ajouter")
     */
    public function ajouter(Request $request){

        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $proprietaire=$form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($proprietaire);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('proprietaire/ajouter.html.twig',[
            "form"=>$form->createView(),
            "Titre"=>"Nouveau Propriétaire"
        ]);
    }

    /**
     * @Route("/proprietaire/modifier/{id}", name="proprietaire_modifier")
     */
    
    public function modifier($id, Request $request)
    {
        //récupérer le repository (une connexion à la table en gros...)
        $repository= $this->getDoctrine()->getRepository(Proprietaire::class);
        $proprietaire = $repository->find($id);

        $form = $this->createForm(ProprietaireType::class, $proprietaire);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $proprietaire=$form->getData();

            //une connexion à la BDD par l'entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($proprietaire);
            $em->flush();

            return $this->redirectToRoute("proprietaire");
        }

        return $this->render('proprietaire/ajouter.html.twig', [
            "form"=>$form->createView(),
            "Titre"=>"Modifier un propriétaire"        
        ]);
    }

    /**
     * @Route("/proprietaire/verif/{id}", name="proprietaire_verif")
     */

    public function verif($id, Request $request)
    {
        //récupérer le repository (une connexion à la table en gros...)
        $repository= $this->getDoctrine()->getRepository(Proprietaire::class);
        $proprietaire = $repository->find($id);

        return $this->render('proprietaire/verification.html.twig', [
            "proprietaire"=>$proprietaire,
            "Titre"=>"Supprimer le proprietaire"        
        ]);
    }

    /**
     * @Route("/proprietaire/supprimer/{id_proprietaire}", name="proprietaire_supprimer")
     */
    
    public function supprimer($id_proprietaire, Request $request)
    {
        //récupérer le repository (une connexion à la table en gros...)
        $repository= $this->getDoctrine()->getRepository(Proprietaire::class);
        $proprietaire = $repository->find($id_proprietaire);

        //une connexion à la BDD par l'entity manager
        $em = $this->getDoctrine()->getManager();
        $em->remove($proprietaire);
        $em->flush();
        
        return $this->redirectToRoute("proprietaire");

    }
}
