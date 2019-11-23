<?php

namespace App\Controller;
use App\Entity\TexteFooterContact;
use App\Form\AdminFooterContactType;
use App\Repository\TexteFooterContactRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminContactController extends AbstractController
{   

   

    /**
     * @Route("/admin/contact", name="admin_contact" , methods={"GET","POST"})
     */
    public function index(Request $request, TexteFooterContactRepository $texteFooterContactRepository,     ObjectManager $entityManager)
    {   $contact=new TexteFooterContact();
        $form=$this->createForm(AdminFooterContactType::class,$contact);
         
        $form->handleRequest($request);
       
         if($form->isSubmitted() && $form->isValid()){
           
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($contact);
             $entityManager->flush();
             return $this->redirectToRoute('admin_contact');
         }
         dump($texteFooterContactRepository);
            return $this->render('admin_contact/index.html.twig', [
                'contacts'=> $texteFooterContactRepository->findAll(),
                'form'=> $form->createView()
            ]);
            
    }
   /**
    * Supprimer les choix contacts footer de la bdd
    * @Route("/admin/contact/delete/{id}", name="delete_admin_contact")
    */
   
    public function deleteTexteFooterContact($id)
    {   
        //Supprimer les infos contatcs de la bdd
        $contactpost= $this->getDoctrine()->getRepository(TexteFooterContact::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($contactpost);
        $em->flush();
        return $this->redirectToRoute('admin_contact');
    }
    /**
     * afficher les resultats du gestion contacts en admin dans le footer en front
     */
    public function show(TexteFooterContactRepository $texteFooterContactRepository)

    {//ici récupere le dossier inscrption de l'adrent pour l'afficher dans le dossier admin adherent
        $texteFooterContactRepository->findAll();
        return $this->render('footer.html.twig', [
            'contacts'=> $texteFooterContactRepository->findAll(),
        ]);
    }

    
}
