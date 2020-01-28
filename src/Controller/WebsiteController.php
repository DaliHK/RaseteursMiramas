<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\ContactType;
use App\Entity\TexteAccueil;
use App\Entity\Participation;
use App\Form\EditAdherentType;
use App\Entity\DossierInscription;
use App\Service\PaginationService;
use App\Form\DossierInscriptionType;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use App\Repository\TexteAccueilRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ModeleDocumentRepository;
use App\Repository\CarouselPictureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TexteFooterContactRepository;
use App\Repository\ParticipationEvenementRepository;
use App\Repository\TextePresentationEcoleRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class WebsiteController extends AbstractController

{
    /**
     * @Route("/", name="home")
     */

    public function index(EvenementRepository $repo, TexteFooterContactRepository $footer, CarouselPictureRepository $carousel, TexteAccueilRepository $repotexte)
    {
        $evenements = $repo->findUpcomingEvents();
        $texte = $repotexte->findAll();

        return $this->render('home/home.html.twig', [
            'evenements' => $evenements,
            'picture'=>$carousel->findAll(),
            'textes' => $texte
        ]);
    }

    /**
     * @Route("/evenements/{page<\d+>?1}", name="evenements")
     */
    public function listeEvenements($page, PaginationService $pagination, EvenementRepository $repo, TokenStorageInterface $tokenStorage)
    {
        $pagination->setEntityClass(Evenement::class)
                   ->setPage($page);

        $user=$tokenStorage->getToken()->getUser();

        return $this->render('event/events.html.twig', [
            'pagination' => $pagination,
            'user' => $user
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
    public function pageContact(Request $request, \Swift_Mailer $mailer, TexteFooterContactRepository $repo)
    {
        $form = $this->createForm(ContactType::class);
        $contacts = $repo->findAll();

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
            'form' => $form->createView(),
            'contacts' => $contacts
            ]);
    }

    /**
      * Afficher les documents viérges pour l'inscription
     * @Route("/dossier/vierge", name="dossier_inscription_vierge")
     */
    public function fileInsciption(ModeleDocumentRepository $modeleDocumentRepository)
    {
    
        return $this->render('website/dossierInscriptionVierge.html.twig',[
            'documentModele'=> $modeleDocumentRepository->findAll()
        ]);
         
    }
    
    /**
     * Permet d'afficher un seul événement
     * @Route("/ecole", name="ecole")
     * 
     * @return Response
     */
    public function pageEcole(TextePresentationEcoleRepository $repositorypresentation)
    {
        $contenuEcole = $repositorypresentation->findAll();

            return $this->render('website/ecole.html.twig', [
            'textes' => $contenuEcole
            ]);
    }
    

    /**
     * @Route("/footer", name="footer")
     */
    public function footer(TexteFooterContactRepository $repo)

    {
        $adresse = $repo->findOneBy(array('id' => 1))->getAdresse();
        $contacts = $repo->findAll();
        
        return $this->render('footer/index.html.twig', [
            'adresse' => $adresse,
            'contacts' => $contacts
        ]);
    }
     
}
