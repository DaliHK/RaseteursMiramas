<?php

namespace App\Controller;

use App\Repository\AdherentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminListeAdherentController extends AbstractController
{
    /**
     * @Route("/admin/liste_adherent", name="admin_liste_adherent")
     */
    public function index(AdherentRepository $repo)
    { 
        $adherents=$repo->findAll();


        return $this->render('admin_liste_adherent/index.html.twig', [
            'adherents' => $adherents
        ]);
    }




}
