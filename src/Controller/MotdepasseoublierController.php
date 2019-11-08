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
    public function entrerEmail(Request $request)
    {

        $ad = new Adherent();

/*          $email = $request->query->get('email');
 */         
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Adherent::class, $ad)->findAll($ad);

        $form = $this->createForm(EntrermailType::class, $ad);  
        $form->handleRequest($request);


        if ($request->isMethod('POST')) {

            if ($email === null) {
                $this->addFlash('danger', 'Email Inconnu, recommence !');
                return $this->redirectToRoute('entrer_mail');
            }
    }
        return $this->render('motdepasseoublier/entreradressemail.html.twig', [
            'form' => $form->createView(),
        ]);
}
}