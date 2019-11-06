<?php

namespace App\Controller;

use App\Form\EditAdherentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController

{
    /**
     * @Route("/", name="home")
     */

    public function home(){
    
        return $this -> render('/home/home.html.twig');

    }

    /**
     * @Route("adherent/profile", name="adherent_profile")
     * @param UserInterface $userProfile
     */

    public function adherentProfile(UserInterface $userProfile){


        return $this -> render('/website/adherentProfile.html.twig',[
            'user'=> $userProfile
        ]);
    }

    /**
     * @Route("adherent/profile/edit", name="adherent_edit_profile")
     * @param Request $request
     * @param UserInterface $user
     * @return RedirectResponse|Response
     */
    
    public function adherentEditProfile(Request $request, UserInterface $userProfile)
    {
        //affiche le formulaire deja enregistré de l'user pour qu'il puisse le consulter ou modifier
        $form = $this->createForm(EditAdherentType::class, $userProfile);
        //j'envoie les informations modifié à la base de données 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($userProfile);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
            $entityManager->flush();
            return $this->redirectToRoute("{{path('adherent_profile')}}");
        }
        return $this->render('/website/adherentEditProfile.html.twig', [
            'user' => $userProfile,
            'adherent' => $form->createView()
        ]);
    }

}
