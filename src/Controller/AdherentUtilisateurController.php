<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\InscriptionType;
use App\Form\EditAdherentType;
use App\Form\RegistrationType;
use App\Form\ResetPasswordType;
use App\Entity\DossierInscription;
use App\Form\DossierInscriptionType;
use Symfony\Component\Form\FormError;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParticipationEvenementRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AdherentUtilisateurController extends AbstractController
{
    /**
     * @Route("/adherent/inscription", name="inscription")
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $adherent = new Adherent();
        $form = $this->createForm(RegistrationType::class, $adherent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){ 
            $hash = $encoder->encodePassword($adherent, $adherent->getPassword()); 

            $adherent->setPassword($hash);   
            //$adherent->addRole("ROLE_ADMIN");
            
            $manager->persist($adherent);
            $manager->flush();

            $this->addFlash('success', 'Votre compte à bien été enregistré.');
             return $this->redirectToRoute('login_adherent');
        }
        return $this->render('adherentUtilisateur/adherentregistration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/adherent/login", name="login_adherent")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Permet d'afficher un seul événement
     * @Route("/adherent/evenements/{id}", name="detailevenement")
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
     * @Route("/adherent/evenements/delete/inscription/{id}", name="recruiter_offer_delete")
     * @param $id
     * @return RedirectResponse
     */
    
     public function deleteInscription($id)
    {
        $em = $this->getDoctrine()->getManager();
        $participation = $em->getRepository(ParticipationEvenement::class)->find($id);
        $em->remove($participation);
        $em->flush();
    }

    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /* ------Gestion page Adherent -------*/
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    /**
     * 
     * Afficher les informations de l'adherent et supprimer ces evenements
     * Afficher les événements de l'adherent
     * Uploader dossier d'inscription
     * @Route("adherent/profile", name="adherent_profile")
     * @param UserInterface $userProfile
     */

    public function adherentProfile(UserInterface $userProfile ,AdherentRepository $adherent,Request $request, EvenementRepository $evenement,ParticipationEvenementRepository $participation ){

       
        //Recuperer les participations
        $participations = $participation->findAll();


        //Upload du dossier d'inscription 
        $newFileRegistration = new DossierInscription();
        $registration = $this->createForm(DossierInscriptionType::class, $newFileRegistration);
        $registration->handleRequest($request);
        
        if ($registration->isSubmitted() && $registration->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            
            // Stock les fichiés  uploader dans une variable
            $file1 = $newFileRegistration->getphotoIdentite();
            $file2 = $newFileRegistration->getCertificatMedical();
            $file3 = $newFileRegistration->getDroitImage();
            $file4 = $newFileRegistration->getDroitTransport();
            $file5 = $newFileRegistration->getDroitPratique();
            $file6 = $newFileRegistration->getRenseignementsMedicaux();
            $file7 = $newFileRegistration->getrenseignementsgeneraux();
            $file8 = $newFileRegistration->getDroitEntrainement();

            // Géneration de nom pour les fichiers pour éviter les doublons et sécuriser 
            $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
            $fileName2 = $this->generateUniqueFileName().'.'.$file2->guessExtension();
            $fileName3 = $this->generateUniqueFileName().'.'.$file3->guessExtension();
            $fileName4 = $this->generateUniqueFileName().'.'.$file4->guessExtension();
            $fileName5 = $this->generateUniqueFileName().'.'.$file5->guessExtension();
            $fileName6 = $this->generateUniqueFileName().'.'.$file6->guessExtension();
            $fileName7 = $this->generateUniqueFileName().'.'.$file7->guessExtension();
            $fileName8 = $this->generateUniqueFileName().'.'.$file8->guessExtension();


        
            // Envoie les fichiés dans le dossier public, la route est dans le fichier services.yaml
            try {

                $file1->move(
                $this->getParameter('registration_directory'), 
                $fileName1
                );
                $file2->move(
                $this->getParameter('registration_directory'),
                $fileName2
                );
                $file3->move(
                $this->getParameter('registration_directory'),
                $fileName3
                );
                $file4->move(
                $this->getParameter('registration_directory'),
                $fileName4
                );
                $file5->move(
                $this->getParameter('registration_directory'),
                $fileName5
                );
                $file6->move(
                $this->getParameter('registration_directory'),
                $fileName6
                );
                $file7->move(
                $this->getParameter('registration_directory'),
                $fileName7
                );
                $file8->move(
                $this->getParameter('registration_directory'),
                $fileName8
                );
                
                
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            //Envoie les noms relié au fichier dans la BDD
            $newFileRegistration->setphotoIdentite($fileName1);
            $newFileRegistration->setCertificatMedical($fileName2);
            $newFileRegistration->setDroitImage($fileName3);
            $newFileRegistration->setDroitTransport($fileName4);
            $newFileRegistration->setDroitPratique($fileName5);
            $newFileRegistration->setRenseignementsMedicaux($fileName6);
            $newFileRegistration->setrenseignementsgeneraux($fileName7);
            $newFileRegistration->setDroitEntrainement($fileName8);

            $newFileRegistration->setAdherent($userProfile);

            // ... persist the $product variable or any other work
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newFileRegistration);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('adherent_profile'));
        }

        return $this -> render('/website/adherentProfile.html.twig',[
           
            'user'=> $userProfile,
            'form' => $registration->createView(),
            'fileRegistration'=> $newFileRegistration,
            'participation'=>$participations
            ]);
    
    }

    /**
     * Permet de modifier les informations personnelles de l'adherent
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
     * Supprimer un evenement de l'adherent
     * @Route("adherent/profile/delete/evenement/{id}", name="delete_evenement")
     * @param $id
     */
     public function deleteRegistrationEvenement($id )
    {

        $participation = $this->getDoctrine()->getRepository(ParticipationEvenement::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($participation);
        $em->flush();

    }

}

