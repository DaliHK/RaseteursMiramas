<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Form\EditAdherentType;
use App\Entity\DossierInscription;
use App\Form\DossierInscriptionType;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParticipationEvenementRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class WebsiteController extends AbstractController

{
    /**
     * @Route("/", name="home")
     */


    public function index(EvenementRepository $repo)
    {
        
        $evenements = $repo->findUpcomingEvents();

        return $this->render('home/home.html.twig', [
            'evenements' => $evenements
        ]);

    }

    /**
     * @Route("/visiteur/evenements", name="evenements")
     */
    public function listeEvenements(EvenementRepository $repo)
    {
       
        $evenements = $repo->findAll();

        return $this->render('event/events.html.twig', [
            'evenements' => $evenements
            
        ]);
    }

    /**
     * Permet d'afficher un seul événement
     * @Route("/visiteur/evenements/{id}", name="detailevenementvisiteur")
     * 
     * @return Response
     */

    public function detailEvenements($id, EvenementRepository $repo)
    {
        $evenement = $repo->findAll();
        $evenement = $repo->find($id);
        $manager = $this->getDoctrine()->getManager();

            return $this->render('visiteur/visiteur_detailEvenements.html.twig', [
                'evenement' => $evenement,
                'id' => $id
            ]);
    }

    /**
     * Permet d'afficher un seul événement
     * @Route("/contact", name="contact")
     * 
     * @return Response
     */

    public function pageContact()
    {

            return $this->render('website/contact.html.twig');

    }

    /**
     * Permet d'afficher un seul événement
     * @Route("/ecole", name="ecole")
     * 
     * @return Response
     */

    public function pageEcole()
    {

            return $this->render('website/ecole.html.twig');

    }
     
     
}
