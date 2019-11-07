<?php

namespace App\Controller;


use App\Repository\AdherentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminListeAdherentController extends AbstractController
{


    /**
     * @Route("/admin/liste_adherent", name="admin_liste_adherent")
     */
    public function index(AdherentRepository $repo, Request $request )
    {
    //création d'un formulaire recherche par nom
        $form=$this->createFormBuilder()
            ->add('nom', SearchType::class,[
                'required'=> false,
                'label'=> false,
                'attr'=>[
                    'placeholder'=> 'Nom'
                ]
            ])
            ->add('rechercher', SubmitType::class)
            ->getForm()
        ;
    //requete dans le formulaire pour rechercher 1 adhérent par son nom 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $adherents=$repo->findByNameField($form->getData()['nom']);
            // dump($adherents);die;
            return $this->render('admin_liste_adherent/index.html.twig', [
                'adherents' => $adherents,
                'form'=> $form->createView()
            ]);
        }
    //ici affichage de tous les adhérents
        $adherents= $repo->findAll();
        return $this->render('admin_liste_adherent/index.html.twig', [
            'adherents' => $adherents,
            'form'=> $form->createView()
        ]);
    }
    
       
    }
    
   

    

