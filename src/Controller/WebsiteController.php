<?php

namespace App\Controller;

use App\Repository\AdherentRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    
    public function index(AdherentRepository $repo)
    {
       
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/evenements", name="evenements")
     */
    
    public function eventsList(EvenementRepository $repo)
    {

        $events = $repo->findAll();
       
        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }
}
