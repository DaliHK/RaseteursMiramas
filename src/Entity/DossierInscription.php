<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adherent", inversedBy="dossierInscription", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
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

    public function getPhotoIdentite(): ?string
    {
        return $this->photoIdentite;
    }

    public function setPhotoIdentite(string $photoIdentite): self
    {
        $this->photoIdentite = $photoIdentite;

        return $this;
    }

    public function getCertificatMedical(): ?string
    {
        return $this->CertificatMedical;
    }

    public function setCertificatMedical(string $CertificatMedical): self
    {
        $this->CertificatMedical = $CertificatMedical;

        return $this;
    }

    public function getDroitImage(): ?string
    {
        return $this->DroitImage;
    }

    public function setDroitImage(string $DroitImage): self
    {
        $this->DroitImage = $DroitImage;

        return $this;
    }

    public function getDroitTransport(): ?string
    {
        return $this->droitTransport;
    }

    public function setDroitTransport(string $droitTransport): self
    {
        $this->droitTransport = $droitTransport;

        return $this;
    }

    public function getDroitPratique(): ?string
    {
        return $this->droitPratique;
    }

    public function setDroitPratique(string $droitPratique): self
    {
        $this->droitPratique = $droitPratique;

        return $this;
    }

    public function getDroitEntrainement(): ?string
    {
        return $this->droitEntrainement;
    }

    public function setDroitEntrainement(string $droitEntrainement): self
    {
        $this->droitEntrainement = $droitEntrainement;

        return $this;
    }

    public function getRenseignementsMedicaux(): ?string
    {
        return $this->renseignementsMedicaux;
    }

    public function setRenseignementsMedicaux(string $renseignementsMedicaux): self
    {
        $this->renseignementsMedicaux = $renseignementsMedicaux;

        return $this;
    }

    public function getRenseignementsgeneraux(): ?string
    {
        return $this->renseignementsgeneraux;
    }

    public function setRenseignementsgeneraux(string $renseignementsgeneraux): self
    {
        $this->renseignementsgeneraux = $renseignementsgeneraux;

        return $this;
    }
}
