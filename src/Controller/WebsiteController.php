<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController

{
    /**
     * @Route("adherent/profile", name="adherent_profile")
     * @param UserInterface
     */
    public function adherentProfile(UserInterface $user){


        return $this -> render('/website/adherentProfile.html.twig',[
            'user'=> $user
        ]);


    }


    /**
     * @Route("adherent/profile/edit", name="adherent_edit_profile")
     * @param Request $request
     * @param UserInterface $user
     * @return RedirectResponse|Response
     */
    
    public function adherentEditProfile(Request $request, UserInterface $user)
    {
        //affiche le formulaire deja enregistré de l'user pour qu'il puisse le consulter ou modifier
        $form = $this->createForm(AdherentFormType::class, $user);
        //j'envoie les informations modifié à la base de données 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('adherent_profile');
        }
        return $this->render('/website/adherentEditProfile.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

}
