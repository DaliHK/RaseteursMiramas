<?php

namespace App\Controller;

use App\Repository\AdherentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteController extends AbstractController
{
    /**
     * @Route("/adherent", name="page_adherent")
     */
    
    public function index()

    {
        return $this->render('website/index.html.twig');
         
    }
}
