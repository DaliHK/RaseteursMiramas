<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\InscriptionType;
use App\Form\RegistrationType;
use App\Form\ResetPasswordType;
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
          //  $adherent->addRole("ROLE_ADMIN");
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
    
     public function deleteInscription(ParticipationEvenementRepository $repo)
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

}
