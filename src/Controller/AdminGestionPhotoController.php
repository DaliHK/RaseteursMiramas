<?php

namespace App\Controller;


use App\Entity\SourcePhoto;
use App\Form\SourcePhotoType;
use App\Repository\SourcePhotoRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminGestionPhotoController extends AbstractController
{

    /**
     * @Route("/admin/gestion/photo", name="admin_gestion_photo")
     * @param Request $request
     * @param Filesystem $fileNames
     * @param SourcePhotoRepository $sourcePhoto
     */

    public function gestionPhoto(Request $request,Filesystem $filesystem, SourcePhotoRepository $sourcePhoto)
    {
         //Instencie la variable NewPicture pour utiliser c'est prop  et affecte la variable sourcePhotoForm pour crée le form.
        $newPicture = new SourcePhoto();
        $sourcePictureForm = $this->createForm(SourcePhotoType::class, $newPicture);
        $sourcePictureForm->handleRequest($request);
       
        if ($sourcePictureForm->isSubmitted() && $sourcePictureForm->isValid()) {

            // Stock les fichiés  uploader dans une variable
            $category = $newPicture->getCategorie();
            $title = $newPicture->getTitre();
            $date = $newPicture->getDate();
           
            $path = $this->getParameter('sourcePhoto_directory');

            //Crée un dossier avec l'id de l'adherent connecté à l'amplacement du $path
             if (!$path) {

                $path = $filesystem->mkdir($path.'source_photo',0700);
                
            }

            // Géneration de nom unique pour les fichiers pour éviter les doublons et sécuriser
           /*  $arrayPicture=[$picture1,$picture2,$picture3,$picture4];
            $fileNames = []; */

           /*  for ($i=0; $i <count($arrayPicture) ; $i++) { 

               $fileNames[] = $this->generateUniqueFileName().'.'.$arrayPicture[$i]->guessExtension();
            }
            */
          
            $fileNames = $this->generateUniqueFileName().'.'.$title->guessExtension();
 
            // Envoie les fichiés dans le dossier carousel
           /*  for ($a=0; $a <count($fileNames) ; $a++) { 
              $arrayPicture[$a]->move($path , 
                    $fileNames[$a]);
            }
            */

            $title->move($path , 
                    $fileNames);
            
            //Envoie les noms relié au fichier dans la BDD
            $newPicture->setphoto1($fileNames);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newPicture);
            $entityManager->flush();


            return $this->redirect($this->generateUrl('admin_gestion_photo'));

        }

        return $this->render('admin_gestion_photo/gestionPhoto.html.twig', [

             'sourcePictureForm' => $sourcePictureForm->createView(),
             /* 'sourcePhoto' => $sourcePhoto->findAll() */

        ]);
    }
}
