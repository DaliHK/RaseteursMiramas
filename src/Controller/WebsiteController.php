<?php

namespace App\Controller;

use App\Repository\AdherentRepository;
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
}
