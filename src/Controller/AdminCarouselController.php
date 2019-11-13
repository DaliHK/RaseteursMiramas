<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCarouselController extends AbstractController
{
    /**
     * @Route("/admin/carousel", name="admin_carousel")
     */
    
    public function adminCarousel(){

        return $this->render('admin_carousel/carousel.html.twig');
    }
}
