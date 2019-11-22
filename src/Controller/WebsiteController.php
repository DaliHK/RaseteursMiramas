<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\ContactType;
use App\Entity\Participation;
use App\Form\EditAdherentType;
use App\Entity\DossierInscription;
use App\Service\PaginationService;
use App\Form\DossierInscriptionType;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/visiteur/evenements/{page<\d+>?1}", name="evenements")
     */
    public function listeEvenements($page, PaginationService $pagination, EvenementRepository $repo)
    {
        $pagination->setEntityClass(Evenement::class)
                   ->setPage($page);

        return $this->render('event/events.html.twig', [
            'pagination' => $pagination
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
     */
    public function pageContact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $message = (new \Swift_Message('Nouveau message du site'))
                ->setFrom($contactFormData['from'])
                ->setTo('raseteur.test@gmail.com')
                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                );

                $mailer->send($message);
            $this->addFlash('success', 'Merci, votre message a bien été envoyé');
            return $this->redirectToRoute('home');
        }
        
            return $this->render('website/contact.html.twig', [
            'form' => $form->createView()
            ]);
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
