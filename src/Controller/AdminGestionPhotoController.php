<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminGestionPhotoController extends AbstractController
{

    /**
     * @Route("/admin/gestion/photo", name="admin_gestion_photo")
     */

    public function index()
    {
        return $this->render('admin_gestion_photo/gestionPhoto.html.twig', [
            'controller_name' => 'AdminGestionPhotoController',
        ]);
    }
}
