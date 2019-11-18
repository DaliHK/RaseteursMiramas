<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\EntrermailType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PseudoublierController extends AbstractController
{
    /**
     * @Route("/pseudo/oublier", name="pseudo_oublier")
     * @param AdherentRepository $repo
     * @return Response
     */
    public function pseudoOublier(Request $request, ObjectManager $manage, \Swift_Mailer $mailer)
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
                $message = (new \Swift_Message('Hello Email')) 
                ->setFrom('raseteur.test@gmail.com')
                ->setTo($adherent->getEmail())
                ->setBody(
                    $this->renderView(
                        'motdepasseoublier/envoimailpseudo.html.twig',
                        ['nom' => $mailuser->getNom(), //recuperer dans BDD /adherent/utilisateur
                        'prenom' => $mailuser->getPrenom(),
                        'username' => $mailuser->getUsername(),
                        ]
                    ),
                    'text/html'
                )
                ;
                $mailer->send($message);
                }
                return $this->redirectToRoute('login_adherent');
            }
        return $this->render('pseudo_oublier/pseudooublier.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
