<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminGestionPhotoController extends AbstractController
{

    /**
     * @Route("/admin/gestion/photo", name="admin_gestion_photo")
     */

    public function gestionPhoto()
    {
         //Instencie la variable NewPicture pour utiliser c'est prop  et affecte la variable carouselForm pour crée le form.
        $newPicture = new Carousel();
        $carouselForm = $this->createForm(AdminCarouselType::class, $newPicture);
        $carouselForm->handleRequest($request);
       
        if ($carouselForm->isSubmitted() && $carouselForm->isValid()) {


            // Stock les fichiés  uploader dans une variable
            $picture1 = $newPicture->getPhoto1();
            $picture2 = $newPicture->getPhoto2();
            $picture3 = $newPicture->getPhoto3();
            $picture4 = $newPicture->getPhoto4();

            $path = $this->getParameter('carousel_directory');

            //Crée un dossier avec l'id de l'adherent connecté à l'amplacement du $path
             if (!$path) {

                $path = $filesystem->mkdir($path.'carousel',0700);
            }

            // Géneration de nom unique pour les fichiers pour éviter les doublons et sécuriser
            $arrayPicture=[$picture1,$picture2,$picture3,$picture4];
            $fileNames = [];

            for ($i=0; $i <count($arrayPicture) ; $i++) { 

               $fileNames[] = $this->generateUniqueFileName().'.'.$arrayPicture[$i]->guessExtension();
            }

            // Envoie les fichiés dans le dossier carousel
            for ($a=0; $a <count($fileNames) ; $a++) { 
              $arrayPicture[$a]->move($path , 
                    $fileNames[$a]);
            }

            
            //Envoie les noms relié au fichier dans la BDD
            $newPicture->setphoto1($fileNames[0]);
            $newPicture->setphoto2($fileNames[1]);
            $newPicture->setphoto3($fileNames[2]);
            $newPicture->setphoto4($fileNames[3]);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newPicture);
            $entityManager->flush();


            return $this->redirect($this->generateUrl('admin_carousel'));

        }

        return $this->render('admin_gestion_photo/gestionPhoto.html.twig', [
            'controller_name' => 'AdminGestionPhotoController',
        ]);
    }
}
