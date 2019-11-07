<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDossierAdherentController extends AbstractController
{
    /**
     * @Route("/admin/dossier_adherent", name="admin_dossier_adherent")
     */
    public function index()
    {
        return $this->render('admin_dossier_adherent/index.html.twig', [
            'controller_name' => 'AdminDossierAdherentController',
        ]);
    }
}
