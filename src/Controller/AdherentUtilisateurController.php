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
use Symfony\Component\Filesystem\Filesystem;
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
     * Function qui est utiliser pour upload dans la function adherentProfile
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
     * Uploade le dossier d'inscription et le supprime
     * @Route("adherent/profile", name="adherent_profile")
     * @param UserInterface $userProfile
     * @param Request $request
     * @param ParticipationEvenementRepository $participation
     * @param Filesystem $filesystem
     */

    public function adherentProfile(UserInterface $userProfile ,Request $request,ParticipationEvenementRepository $participation,Filesystem $filesystem){
       
        //Recupère tout les participations des événements pour l'envoyer dans la view
        $participations = $participation->findAll();

        //Instencie la classe dossierInscription pour utiliser c'est prop  et affecte  la variable registration pour crée la vue.
        $newFileRegistration = new DossierInscription();
        $registration = $this->createForm(DossierInscriptionType::class, $newFileRegistration);

        $registration->handleRequest($request);
        if ($registration->isSubmitted() && $registration->isValid()) {

            //Pour récuperer la route du dossier public/uploads/inscription dans la variable $path 
            $path = $this->getParameter('registration_directory');

            //Crée un dossier avec l'id de l'adherent connecté à l'amplacement du $path
            $fileRegistrationUser = $filesystem->mkdir($path.$userProfile->getId(),0700);
            
            // Stock les fichiés  uploader dans une variable
            $file1 = $newFileRegistration->getphotoIdentite();
            $file2 = $newFileRegistration->getCertificatMedical();
            $file3 = $newFileRegistration->getDroitImage();
            $file4 = $newFileRegistration->getDroitTransport();
            $file5 = $newFileRegistration->getDroitPratique();
            $file6 = $newFileRegistration->getRenseignementsMedicaux();
            $file7 = $newFileRegistration->getrenseignementsgeneraux();
            $file8 = $newFileRegistration->getDroitEntrainement();

            // Géneration de nom unique pour les fichiers pour éviter les doublons et sécuriser 
            $arrayFile = [$file1,$file2,$file3,$file4,$file5,$file6,$file7,$file8];
            $a = 1;
            $arrayFileName = [];

            for ($i=0; $i <count($arrayFile) ; $i++) 
            { 
                $a++;
                $arrayFileName[] = $this->generateUniqueFileName().'.'.$arrayFile[$i]->guessExtension();
            }

            // Envoie les fichiés dans le dossier crée pour l'adherent qui à sont id comme nom
            for ($i=0; $i < count($arrayFile) ; $i++) 
            { 
                $arrayFile[$i]->move($path.$userProfile->getId(), 
                    $arrayFileName[$i]
                );
            }
            
            //Envoie les noms relié au fichier dans la BDD
            $newFileRegistration->setphotoIdentite($arrayFileName['0']);
            $newFileRegistration->setCertificatMedical($arrayFileName['1']);
            $newFileRegistration->setDroitImage($arrayFileName['2']);
            $newFileRegistration->setDroitTransport($arrayFileName['3']);
            $newFileRegistration->setDroitPratique($arrayFileName['4']);
            $newFileRegistration->setRenseignementsMedicaux($arrayFileName['5']);
            $newFileRegistration->setrenseignementsgeneraux($arrayFileName['6']);
            $newFileRegistration->setDroitEntrainement($arrayFileName['7']);
            $newFileRegistration->setAdherent($userProfile);
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
        //Affiche le formulaire deja enregistré de l'user pour qu'il puisse le consulter ou modifier
        $form = $this->createForm(EditAdherentType::class,$userProfile); //On utiliser le userProfile pour générer le formulaire prés remplis
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

    /**
     * Supprimer le dossier d'inscription
     * @Route("adherent/profile/delete/folderRegister/{id}", name="delete_folder_inscription")
     * @param $id
     */
     public function deleteFolderRegistration($id, UserInterface $userProfile,Filesystem $fileSystem )
    {   
         //Supprimer le fichier dans le dossier qui a l'id du user connecté
        $path = $this->getParameter('registration_directory');
        $fs = new Filesystem(); 
        $fs->remove($path.$userProfile->getId()); 
        
        //Supprimer les nom des fichiés dans la BDD
        $folderRegister = $this->getDoctrine()->getRepository(DossierInscription::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($folderRegister);
        $em->flush();
        return $this->redirectToRoute('adherent_profile');
    }
}

