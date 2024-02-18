<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'DateduJour' => date('d/m/Y'),
        ]);
    }

    /**
     * @Route("/{nomDuDossier}", name="dossier")
     */
    public function afficherDossier($nomDuDossier, Request $request){
        $finder = new Finder();
        $finder->files()->in("../public/photos/".$nomDuDossier);

        /*
        *foreach($finder as $file){
        *    var_dump($file);
        *}
        */

        $form = $this->createFormBuilder()
        ->add('photo', FileType::class, array('label' => 'Ajouter une photo'))
        ->add('save', SubmitType::class, array('label' => 'Envoyer'))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data["photo"]->move(
                "../public/photos/".$nomDuDossier, 
                $data["photo"]->getClientOriginalName()
            );
        }


        return $this->render('home/afficherDossier.html.twig', [
            'nomDuDossier' => $nomDuDossier,
            'fichiers' => $finder,
            "form"=>$form->createView(),
        ]);
    }
}
