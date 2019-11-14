<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\CreermdpType;
use App\Form\EntrermailType;
use App\Form\MotpasseoublierType;
use Symfony\Component\Form\FormError;
use App\Repository\AdherentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;


class MotdepasseoublierController extends AbstractController
{
    /**
     * @Route("/entrermail", name="entrer_mail")
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param AdherentRepository $repo
     * @return Response
     */

    public function entrerEmail(Request $request, ObjectManager $manager, \Swift_Mailer $mailer, UserPasswordEncoderInterface $encoder)
    {

        $user= $this->getDoctrine()->getRepository(Adherent::class);

        $adherent = new Adherent(); //cloner class adherent pour la gestion d'erreur //une nouvelle table? une classe fille?

        $form = $this->createForm(EntrermailType::class, $adherent);  
        $form->handleRequest($request);

        if($form->isSubmitted()){ 
        $usermail = $adherent->getEmail(); //adresse mail entrée par utilisateur dans formulaire
        $mailuser = $user->findOneByEmail($usermail); //recherche dans la BDD (si ca existe renvoi tous les infos de l'utilisateur sinon ca renvoi null)
        
            if ($mailuser === null) {
             $this->addFlash('error', 'Email Inconnu !'); //ca ne functionne pas
             return $this->redirectToRoute('entrer_mail');
            } 
            else{
                function Genere_Password() //création d'un nouveau mot de passe
                {
                    // Initialisation des caractères utilisables
                    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
                    $password ="";
                    for($i=0;$i<8;$i++)
                    {
                        $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
                    }
                    return $password;
                }
                
                $nouveau_mot_de_passe = Genere_Password();

                $mailuser->setPassword($nouveau_mot_de_passe); //envoie et remplace nouveau mot de passe dans la BDD
                $manager->flush();
                    
                $url = $this->generateUrl('verification_de_user', [], UrlGeneratorInterface::ABSOLUTE_URL);

                $message = (new \Swift_Message('Hello Email')) 
                ->setFrom('raseteur.test@gmail.com')
                ->setTo($adherent->getEmail())
                ->setBody(
                    $this->renderView(
                        'motdepasseoublier/envoimail.html.twig',
                        ['nom' => $mailuser->getNom(), //recuperer dans BDD /adherent/utilisateur
                        'prenom' => $mailuser->getPrenom(),
                        'mot_de_passe' => $nouveau_mot_de_passe,
                        'url'=>$url
                        ]
                    ),
                    'text/html'
                )
                ;
                $mailer->send($message);
                }
                return $this->redirectToRoute('verification_de_user');
            }
        return $this->render('motdepasseoublier/entreradressemail.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/verification_user", name="verification_de_user")
     * @param AdherentRepository $repo
     * @return Response
     */
    public function verificationMdp(Request $request, ObjectManager $manager)
    {
        $user1= $this->getDoctrine()->getRepository(Adherent::class);

        $adherent1 = new Adherent(); 

        $form = $this->createForm(MotpasseoublierType::class, $adherent1);  
        
        $form->handleRequest($request);

        if($form->isSubmitted()){ 
        $usermail1 = $adherent1->getEmail(); //adresse mail entrée par utilisateur dans formulaire
        $userpassword = $adherent1->getPassword();
        $mailuser1 = $user1->findOneByEmail($usermail1); //recherche dans la BDD (si ca existe renvoi tous les infos de l'utilisateur sinon ca renvoi null)
        $mailuser1password = $mailuser1->getPassword();

            if ($mailuser1 !== null && $mailuser1password === $userpassword) { //si l'adressemail est bon et le mdp est la bon on renvoie sur la page creation de mdp
            return $this->redirectToRoute('creer_mot_passe');
            } 
                else{
                $this->addFlash('error', 'Invalide value !');
                return $this->redirectToRoute('verification_de_user');
                }
        }
       
        return $this->render('motdepasseoublier/verificationmotdepasse.html.twig', [
            'form' => $form->createView(),
         ]);
    }

    /**
     * @Route("/creation_mdp", name="creer_mot_passe")
     * @param AdherentRepository $repo
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function creationMdp(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user= $this->getDoctrine()->getRepository(Adherent::class);

        $adherent = new Adherent(); 

        $form = $this->createForm(CreermdpType::class, $adherent);  
        $form->handleRequest($request);

        if($form->isSubmitted()){ 
            $usermail = $adherent->getEmail(); //adresse mail entrée par utilisateur dans formulaire
           
            $mailuser = $user->findOneByEmail($usermail); //recherche dans la BDD (si ca existe renvoi tous les infos de l'utilisateur sinon ca renvoi null)

            $hash = $encoder->encodePassword($mailuser, $adherent->getPassword()); 
        
            $mailuser->setPassword($hash);   
            $manager->merge($mailuser);
            $manager->flush();
        
        $this->addFlash('success', 'Votre mot de passe à bien été enregistré.');
        return $this->redirectToRoute('login_adherent');
        }
        return $this->render('motdepasseoublier/creermotdepasse.html.twig', [
        'form' => $form->createView(),
         ]);
    }
}
