<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierInscriptionRepository")
 */
class DossierInscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    //Supprimer cascade et rajouter nullable=true, onDelete="SET NULL"
    //A garder lors du merge !!!

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adherent", inversedBy="dossierInscription")
     * @ORM\JoinColumn(nullable=false,nullable=true, onDelete="SET NULL")
     */
    private $adherent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoIdentite;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $CertificatMedical;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DroitImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $droitTransport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $droitPratique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $droitEntrainement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $renseignementsMedicaux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $renseignementsgeneraux;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getPhotoIdentite()
    {
        return $this->photoIdentite;
    }

    public function setPhotoIdentite( $photoIdentite)
    {
        $this->photoIdentite = $photoIdentite;

        return $this;
    }

    public function getCertificatMedical()
    {
        return $this->CertificatMedical;
    }

    public function setCertificatMedical($CertificatMedical)
    {
        $this->CertificatMedical = $CertificatMedical;

        return $this;
    }

    public function getDroitImage()
    {
        return $this->DroitImage;
    }

    public function setDroitImage($DroitImage)
    {
        $this->DroitImage = $DroitImage;

        return $this;
    }

    public function getDroitTransport()
    {
        return $this->droitTransport;
    }

    public function setDroitTransport($droitTransport)
    {
        $this->droitTransport = $droitTransport;

        return $this;
    }

    public function getDroitPratique()
    {
        return $this->droitPratique;
    }

    public function setDroitPratique($droitPratique)
    {
        $this->droitPratique = $droitPratique;

        return $this;
    }

    public function getDroitEntrainement()
    {
        return $this->droitEntrainement;
    }

    public function setDroitEntrainement( $droitEntrainement)
    {
        $this->droitEntrainement = $droitEntrainement;

        return $this;
    }

    public function getRenseignementsMedicaux()
    {
        return $this->renseignementsMedicaux;
    }

    public function setRenseignementsMedicaux( $renseignementsMedicaux)
    {
        $this->renseignementsMedicaux = $renseignementsMedicaux;

        return $this;
    }

    public function getRenseignementsgeneraux()
    {
        return $this->renseignementsgeneraux;
    }

    public function setRenseignementsgeneraux($renseignementsgeneraux)
    {
        $this->renseignementsgeneraux = $renseignementsgeneraux;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->photoIdentite;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
