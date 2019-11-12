<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Form\EditAdherentType;
use App\Entity\DossierInscription;
use App\Form\DossierInscriptionType;
use App\Entity\ParticipationEvenement;
use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParticipationEvenementRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class WebsiteController extends AbstractController

{
    /**
     * @Route("/", name="home")
     */

    public function home(){
    
        return $this -> render('/home/home.html.twig');

    }
    
}
