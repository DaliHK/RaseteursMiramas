<?php

namespace App\Controller;

use App\Entity\SourcePhoto;
use App\Form\AdminCarouselType;
use App\Repository\SourcePhotoRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCarouselController extends AbstractController
{


    /**
     * Function qui est utilisé pour génerer des noms fichiés aléatoir et unique
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/admin/carousel", name="admin_carousel")
     */
    
    public function adminCarousel(Request $request,SourcePhotoRepository $SourcePhoto){

        /* dump($Photo);
        die;  */
        
        /* $pictureEdit = $sourcePhoto->findBy(['categorie' => 'carousel']); */

        //Instencie la variable NewPicture pour utiliser c'est prop  et affecte la variable registration pour crée la vue.

        $newPicture = new SourcePhoto();
        $carouselForm = $this->createForm(AdminCarouselType::class, $newPicture);
        $carouselForm->handleRequest($request);
        /* dump($newPicture);
        die; */

        $carouselForm->handleRequest($request);
        if ($carouselForm->isSubmitted() && $carouselForm->isValid()) {


            // Stock les fichiés  uploader dans une variable
            $file1 = $newPicture->getNom();
            $file2 = $newPicture->getCategorie();

            $path = $this->getParameter('carousel_directory');

            /* if (!$path.'carousel') {

                //Crée un dossier avec l'id de l'adherent connecté à l'amplacement du $path
                $folderCarousel = $filesystem->mkdir($path.'carousel',0700);
            } */
           
            // Géneration de nom unique pour les fichiers pour éviter les doublons et sécuriser 
           $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
          

            // Envoie les fichiés dans le dossier carousel
             $file1->move($path, 
                    $fileName1);

            //Envoie les noms relié au fichier dans la BDD
            $newPicture->setNom($fileName1);
            
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newPicture);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('admin_carousel'));


        }

        return $this->render('admin_carousel/carousel.html.twig',[

            'carousel'=>$carouselForm->createView(),
            'picture'=>$SourcePhoto->findAll(),
            'count'=> $count = 0,
        
        ]);
    }

    /**
     * Supprimer une image d'un carousel
     * @Route("admin/carousel/delete/", name="delete_picture_carousel")
     */
    
     public function deleteFolderRegistration($id,Filesystem $fileSystem )
    {   
       
         //Supprimer le fichier dans le dossier qui a l'id du user connecté
        $path = $this->getParameter('carousel_directory');
        $fs = new Filesystem(); 
        $fs->remove($path.'carousel'); 
        
        //Supprimer les nom des fichiés dans la BDD
        $folderCarousel = $this->getDoctrine()->getRepository(SourcePhoto::class)->findBy(["catagorie"=>"carousel"]);
        $em = $this->getDoctrine()->getManager();
        $em->remove($folderCarousel);
        $em->flush();

        return $this->redirectToRoute('admin_carousel');
        
    }
}
