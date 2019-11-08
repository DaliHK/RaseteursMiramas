<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\InscriptionType;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParticipationEvenementRepository;
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
       
        $evenements = $repo->findAll();

        return $this->render('event/events.html.twig', [
            'evenements' => $evenements
            
        ]);
    }

     /**
     * Permet d'afficher un seul événement
     * @Route("/evenements/{id}", name="detailevenement")
     * 
     * @return Response
     */
    public function detailEvenements($id, EvenementRepository $repo, Request $request, UserInterface $user, AdherentRepository $adherent)
    {
        $participation = new ParticipationEvenement();
        $evenement = $repo->findAll();

        $form = $this->createForm(InscriptionType::class, $participation);
        $form->handleRequest($request);
        $evenement = $repo->find($id);
        $manager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $participation->setAdherent($user);
            $participation->setEvenement($evenement);
            $manager->persist($participation);
            $manager->flush();
        }
        
         $this->addFlash('success','Votre inscription à l\'événement a bien été prise en compte');
            return $this->render('event/detailEvenements.html.twig', [
                'form' => $form->createView(),
                'evenement' => $evenement,
                'id' => $id
            ]);
    }

    /**
     * @Route("/evenements/delete/inscription/{id}", name="recruiter_offer_delete")
     * @param $id
     * @return RedirectResponse
     */
    
     public function deleteInscription(ParticipationEvenementRepository $repo)
    {
        $em = $this->getDoctrine()->getManager();
        $participation = $em->getRepository(ParticipationEvenement::class)->find($id);
        $em->remove($participation);
        $em->flush();
    }

}
