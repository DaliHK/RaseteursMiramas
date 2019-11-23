<?php

namespace App\Controller;

use App\Entity\ModeleDocument;
use App\Form\AdminDocumentsType;
use App\Repository\ModeleDocumentRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use symfony\src\Symfony\Component\HttpFoundation\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminDocumentsController extends AbstractController
{


    /* ------Gestion des documents modeles vierges-------*/
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    /**
     * @Route("/admin/gestionDocuments", name="admin_documents")
     * 
     */
    public function index( Request  $request, ModeleDocumentRepository $modeleDocumentRepository)
    {
            $newDocuments= new ModeleDocument(); 
            $modeleDocument=$this->createForm(AdminDocumentsType::class, $newDocuments);
            $modeleDocument->handleRequest($request);

            if($modeleDocument->isSubmitted() && $modeleDocument->isValid()){
               //dd($modeleDocument['CertificatMedical']->getData());
                // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            
            // Stock les fichiers  uploader dans une variable
           

            $file1 = $newDocuments->getCertificatMedical();
            $file2 = $newDocuments->getDroitImage();
            $file3 = $newDocuments->getDroitTransport();
            $file4 = $newDocuments->getDroitPratique();
            $file5 = $newDocuments->getRenseignementsMedicaux();
            $file6 = $newDocuments->getRenseignementsGeneraux();
            $file7 = $newDocuments->getDroitEntrainement();
            //dump($newDocuments->getRenseignementsMedicaux());
            // Géneration de nom pour les fichiers pour éviter les doublons et sécuriser 
            $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
            $fileName2 = $this->generateUniqueFileName().'.'.$file2->guessExtension();
            $fileName3 = $this->generateUniqueFileName().'.'.$file3->guessExtension();
            $fileName4 = $this->generateUniqueFileName().'.'.$file4->guessExtension();

            $fileName5 = $this->generateUniqueFileName().'.'.$file5->guessExtension();

            $fileName6 = $this->generateUniqueFileName().'.'.$file6->guessExtension();
            $fileName7 = $this->generateUniqueFileName().'.'.$file7->guessExtension();
    
            // Envoie les fichiers dans le dossier public, la route est dans le fichier services.yaml
            try {

                $file1->move(
                $this->getParameter('document_directory'),
                $fileName1
                );
                 $file2->move(
                 $this->getParameter('document_directory'),
                $fileName2
                );
                $file3->move(
                 $this->getParameter('document_directory'),
                 $fileName3
                 );
                $file4->move(
                $this->getParameter('document_directory'),
                $fileName4
                );
                $file5->move(
                $this->getParameter('document_directory'),
                 $fileName5
                 );
                $file6->move(
                $this->getParameter('document_directory'),
                 $fileName6
                 );
                 $file7->move(
                 $this->getParameter('document_directory'),
                 $fileName7
                 );
                
                
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
           
            //Envoie les noms relié au fichier dans la BDD
             $newDocuments->setCertificatMedical($fileName1);
             $newDocuments->setDroitImage($fileName2);
             $newDocuments->setDroitTransport($fileName3);
             $newDocuments->setDroitPratique($fileName4);
          
            $newDocuments->setRenseignementsMedicaux($fileName5);

             $newDocuments->setRenseignementsGeneraux($fileName6);
             $newDocuments->setDroitEntrainement($fileName7);


            // ... persist the $product variable or any other work
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newDocuments);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('admin_documents'));
        }

            return $this -> render('adminDocuments/index.html.twig',[
                'form' => $modeleDocument->createView(),
                'documentModele'=> $modeleDocumentRepository->findAll()
                 ]);
    }


    /**
     * Supprimer les documents vierges de la bdd
     * @Route("admin/gestionDocuments/delete/{id}", name="delete_gestion_documents")
     */
    
    public function deleteDocumentsModele($id)
    {   
        //Supprimer les photos dans la BDD
        $documentPoste = $this->getDoctrine()->getRepository(ModeleDocument::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($documentPoste);
        $em->flush();
        return $this->redirectToRoute('admin_documents');
    }


    
}
