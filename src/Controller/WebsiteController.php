<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EditAdherentType;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    public function adherentProfile(UserInterface $userProfile ,AdherentRepository $adherent){

        dump($adherent);
        die;  
        return $this -> render('/website/adherentProfile.html.twig',[
            
            'user'=> $userProfile
           
        ]);
    }

    /**
     * @Route("adherent/profile/edit", name="adherent_edit_profile")
     * @param Request $request
     * @param UserInterface $user
     * @return RedirectResponse|Response
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    
    public function adherentEditProfile(Request $request, UserInterface $userProfile, UserPasswordEncoderInterface $encoder)
    {
        

        //affiche le formulaire deja enregistré de l'user pour qu'il puisse le consulter ou modifier
        $form = $this->createForm(EditAdherentType::class,$userProfile);
        //j'envoie les informations modifié à la base de données 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Pour encoder le password quand il est modifié
            $hash = $encoder->encodePassword($userProfile, $userProfile->getPassword()); 
            $userProfile->setPassword($hash);  

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
            $entityManager->flush();
            return $this->redirectToRoute('adherent_profile');
        }

        return $this->render('/website/adherentEditProfile.html.twig', [
            'user' => $userProfile,
            'adherent' => $form->createView()
        ]);
    }


    /**
     * @Route("adherent/profile/{id}", name="supression_evenement_inscrit")
     */

    public function FunctionName(UserInterface $userProfile)
    {
     
        $id = $userProfile->getEvenement()->getOwner();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($id); 
        $entityManager->flush();

        return $this->render('adherent_profile');

           
    }

}
