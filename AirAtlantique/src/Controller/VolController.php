<?php

namespace App\Controller;

use DateTime;
use App\Entity\Vol;
use App\Entity\Billet;
use App\Entity\Classe;
use App\Entity\Trajet;
use App\Entity\Aeroport;
use App\Entity\TarifVol;
use App\Entity\SearchVol;
use App\Form\SearchVolType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VolController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Aeroport::class);
        $aeroport = $repository->findAll();

        $search = new SearchVol();
        $form = $this->createForm(SearchVolType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $trajet = $this->FindTrajet($search->getDepart(), $search->getArrivee());
            
            $correspondance = $this->FindVols($trajet, $search->getDate());
            
            return $this->render('vol/vol.html.twig', [
                'depart' => $search->getDepart(), 
                'arrivee' => $search->getArrivee(),
                'trajet' => $trajet,
                'vols' => $correspondance,
                'classes' => $this->getDoctrine()->getRepository(Classe::class)->findAll()
            ]);
        }
        
        return $this->render('vol/index.html.twig', [
            'aeroport' => $aeroport,
            'form' => $form->createView()
        ]);
    }

    private function FindTrajet($depart, $arrive)
    {
        $repository = $this->getDoctrine()->getRepository(Trajet::class);
        $trajets = $repository->findAll();

        $correspondance = array();
        $compteur = 0;

        foreach($trajets as $trajet)
        {
            if(($trajet->getDepart()->getVille()->getNom() == $depart->getNom()) && ($trajet->getArrivee()->getVille()->getNom() == $arrive->getNom()))
            {
                $correspondance[$compteur] = $trajet;
                $compteur++;
            }
        }
        return $correspondance;
    }

    private function FindVols($trajets, $date)
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $vols = $repository->findAll();

        $correspondance = array();
        $compteur =0;
        $date = date_format($date,"Y-m-d");
 
        foreach($vols as $vol){
            $voldate = date_format($vol->getDepart(),"Y-m-d");
            if($voldate == $date){
                foreach($trajets as $trajet){
                    if($vol->getTrajet() == $trajet){
                        $correspondance[$compteur] = $vol;
                        $compteur++;
                    }
                }
            }
        }
        return $correspondance;
    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservation(Request $request)
    {
        if($request->request->get('choix') == null){
            return $this->redirectToRoute("home");
        }
        $repository = $this->getDoctrine()->getRepository(TarifVol::class);
        $tarifvol = $repository->find($request->request->get('choix'));
        $classe = $tarifvol->getTarif()->getClasse();
        $vol = $tarifvol->getVol();

        if($vol->getPlacesRestantes()>0){
            $em = $this->getDoctrine()->getManager();

            $billet = new Billet();
            $billet->setVol($tarifvol);
            $billet->setUser($this->getUser());
            $billet->setDate(new DateTime());
            $em->persist($billet);

            $user = $this->getUser();
            $user->setFidelite($user->getFidelite()+1);
            $em ->persist($user);

            $em->flush();

            $message = "Votre billet pour ce vol a bien été pris.";
        }else{
            $message = "Il n'y a plus de places, votre billet n'a pas été pris.";
        }
        

        return $this->render('vol/reservation.html.twig', [
            'classe' => $classe,
            'vol' => $vol,
            'tarifvol' => $tarifvol,
            'message' => $message
        ]);
    }

    /**
     * @Route("/our-flight", name="our-flight")
     */
    public function our_flight()
    {
        $repository = $this->getDoctrine()->getRepository(Billet::class);

        $billets = $repository->findAll();
        $correspondances = array();
        $compteur = 0;

        foreach($billets as $billet){
            if($billet->getUser() == $this->getUser()){
                $correspondances[$compteur] = $billet;
                $compteur++;
            }
        }

        return $this->render('vol/our_flight.html.twig', [
            "billets" => $correspondances
        ]);
    }

    /**
     * @Route("/verification", name="verif")
     */
    public function verification(Request $request)
    {
        if($request->request->get('id') == null){
            return $this->redirectToRoute("home");
        }
        return $this->render('vol/verif.html.twig', [
            "billet" => $this->getDoctrine()->getRepository(Billet::class)->find($request->request->get("id"))
        ]);
    }

    /**
     * @Route("/delete", name="delete")
     */
    public function delete(Request $request)
    {
        if($request->request->get('id') == null){
            return $this->redirectToRoute("home");
        }
        $billet = $this->getDoctrine()->getRepository(Billet::class)->find($request->request->get("id"));

        $em = $this->getDoctrine()->getManager();
        $em->remove($billet);
        $em->flush();
        
        return $this->redirectToRoute("our-flight");
    }
}
