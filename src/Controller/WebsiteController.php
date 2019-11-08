<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    
    public function index(AdherentRepository $repo)
    {
       
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/evenements", name="evenements")
     */
    
    public function listeEvenements(EvenementRepository $repo)
    {
       
        $events = $repo->findAll();


        return $this->render('event/events.html.twig', [
            'events' => $events
            
        ]);
    }

     /**
     * Permet d'afficher un seul événement
     * @Route("/evenements/{id}", name="detailevenement")
     * 
     * @return Response
     */
    public function detailEvenements($id, EvenementRepository $repo)
    {
    
        $event = $repo->find($id);

        return $this->render('event/detailEvenements.html.twig', [
            'event' => $event,
            'id' => $id
                ]);
    }

    /**
     * Permet d'afficher un seul événement
     * @Route("/evenements/inscription/{id}", name="participer")
     * 
     * @return Response
     */

    public function participerEvenement($id, EvenementRepository $repo, UserInterface $user)
    {
        
        $evenement = $repo->find($id);
        $evenement->addAdherent($user);

         $this->addFlash('success','Votre inscription à l\'événement a bien été prise en compte');
            return $this->redirectToRoute('evenements');

    }
}
