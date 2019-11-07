<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdherentController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
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
            $adherent->addRole("ROLE_ADMIN");
            $manager->persist($adherent);
            $manager->flush();

            $this->addFlash('success', 'Votre compte à bien été enregistré.');
             return $this->redirectToRoute('login_adherent');
        }
        return $this->render('adherent/adherentregistration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login_adherent")
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
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
