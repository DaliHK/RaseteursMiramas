<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeleDocumentRepository")
 */
class ModeleDocument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $certificatMedical;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $droitImage;

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
    private $renseignementsGeneraux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reglement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statuts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCertificatMedical(): ?string
    {
        return $this->certificatMedical;
    }

    public function setCertificatMedical(string $certificatMedical): self
    {
        $this->certificatMedical = $certificatMedical;

        return $this;
    }

    public function getDroitImage(): ?string
    {
        return $this->droitImage;
    }

    public function setDroitImage(string $droitImage): self
    {
        $this->droitImage = $droitImage;

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
        return $this->RenseignementsMedicaux;
    }

    public function setRenseignementsMedicaux(string $RenseignementsMedicaux): self
    {
        $this->RenseignementsMedicaux = $RenseignementsMedicaux;

        return $this;
    }

    public function getRenseignementsGeneraux(): ?string
    {
        return $this->renseignementsGeneraux;
    }

    public function setRenseignementsGeneraux(string $renseignementsGeneraux): self
    {
        $this->renseignementsGeneraux = $renseignementsGeneraux;

        return $this;
    }

    public function getReglement(): ?string
    {
        return $this->reglement;
    }

    public function setReglement(string $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getStatuts(): ?string
    {
        return $this->statuts;
    }

    public function setStatuts(string $statuts): self
    {
        $this->statuts = $statuts;

        return $this;
    }
}
