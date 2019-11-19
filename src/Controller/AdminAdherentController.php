<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\DossierInscription;
use App\Form\AdherentType;

use App\Form\AdminEditAdherentType;
use App\Repository\AdherentRepository;
use App\Repository\DossierInscriptionRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminAdherentController extends AbstractController
{
/**
     * @Route("/accueil", name="admin_index")
     */
    public function indexAdmin(){
        return $this->render('Adminadherent/accueil.html.twig');
    }


    /**
     * @Route("/adherent", name="adherent_index", methods={"GET","POST"})
     */
    public function index(AdherentRepository $adherentRepository, AdherentRepository $repo, Request $request): Response
    {    
        $form=$this->createFormBuilder()
        ->add('nom', SearchType::class,[
           'required'=> false,
           'label'=> 'Recherche par Nom de famille',
            'attr'=>[
                'placeholder'=> 'Nom'
           ]
         ])
         ->add('rechercher', SubmitType::class)
       ->getForm()
    ;
    $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $adherentRepository=$repo->findByNameField($form->getData()['nom']);
            //dump($adherentRepository);die;
            return $this->render('Adminadherent/index.html.twig', [
                'adherents' => $adherentRepository,
                'form'=> $form->createView()
            ]);
    }
    
    return $this->render('Adminadherent/index.html.twig', [
        'adherents' => $adherentRepository->findAll(),
        
        'form'=> $form->createView()
    ]);
    }

    /**
     * @Route("/new", name="adherent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adherent = new Adherent();
        $form = $this->createForm(AdherentType::class, $adherent);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();

            return $this->redirectToRoute('adherent_index');
        }

        return $this->render('Adminadherent/new.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dossier{id}", name="adherent_show", methods={"GET"})
     */
    public function show(Adherent $adherent, DossierInscriptionRepository $repo): Response

    {//ici récupere le dossier inscrption de l'adrent pour l'afficher dans le dossier admin adherent
        $dossierInscription=$repo->findAll();
        return $this->render('Adminadherent/show.html.twig', [
            'adherent' => $adherent,
            'dossierInscriptions'=> $dossierInscription
        ]);
    }

    /**
     * @Route("/dossier{id}/edit", name="adherent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adherent $adherent)
    {
        $form = $this->createForm(AdminEditAdherentType::class, $adherent);
        $form->handleRequest($request);
        $adherentPassword = $adherent->getPassword();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
             $adherent->setPassword($adherentPassword);
            $entityManager->flush();
            $this->addFlash('success', 'le dossier a bien été modifié');
            return $this->redirectToRoute('adherent_index');
        }

        return $this->render('Adminadherent/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dossier{id}", name="adherent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Adherent $adherent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adherent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adherent_index');
    }

     /**
     * @Route("/", name="admin_accueil")
     */
    public function accueil()
    {
        return $this->render('Adminadherent/accueil.html.twig');
    }
}