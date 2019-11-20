<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\InscriptionType;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParticipationEvenementRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    
    public function index(AdherentRepository $repo)
    {
        $evenements = $repo->findAll();
        
        return $this->render('home/home.html.twig', [
            'evenements' => $evenements
        ]);

    }

     
}
