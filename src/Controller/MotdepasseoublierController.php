<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\EntrermailType;
use Symfony\Component\Form\FormError;
use App\Repository\AdherentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;


class MotdepasseoublierController extends AbstractController
{
    /**
     * @Route("/entrermail", name="entrer_mail")
     * @param AdherentRepository $repo
     * @return Response
     */
    public function entrerEmail(Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {

        $user= $this->getDoctrine()->getRepository(Adherent::class);

        $adherent = new Adherent(); //cloner class adherent pour la gestion d'erreur //une nouvelle table? une classe fille?

        $form = $this->createForm(EntrermailType::class, $adherent);  
        $form->handleRequest($request);

        if($form->isSubmitted()){ 
        $usermail = $adherent->getEmail(); //adresse mail entrée par utilisateur dans formulaire
        $mailuser = $user->findOneByEmail($usermail); //recherche dans la BDD (si ca existe renvoi tous les infos de l'utilisateur sinon ca renvoi null)
        
            if ($mailuser === null) {
             $this->addFlash('notice', 'Email Inconnu, recommence !'); //ca ne functionne pas
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

                $message = (new \Swift_Message('Hello Email')) 
                ->setFrom('raseteur.test@gmail.com')
                ->setTo($adherent->getEmail())
                ->setBody(
                    $this->renderView(
                        'motdepasseoublier/envoimail.html.twig',
                        ['nom' => $mailuser->getNom(), //recuperer dans BDD /adherent/utilisateur
                        'prenom' => $mailuser->getPrenom(),
                        'mot_de_passe' => $nouveau_mot_de_passe
                        ]
                    ),
                    'text/html'
                )
                ;
                $mailer->send($message);
                }
        }
        return $this->render('motdepasseoublier/entreradressemail.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}