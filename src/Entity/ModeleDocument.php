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
    private $RenseignementsMedicaux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $renseignementsGeneraux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reglement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statuts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCertificatMedical()
    {
        return $this->certificatMedical;
    }

    public function setCertificatMedical($certificatMedical)
    {
        $this->certificatMedical = $certificatMedical;

        return $this;
    }

    public function getDroitImage()
    {
        return $this->droitImage;
    }

    public function setDroitImage($droitImage)
    {
        $this->droitImage = $droitImage;

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

    public function setDroitEntrainement($droitEntrainement)
    {
        $this->droitEntrainement = $droitEntrainement;

        return $this;
    }

    public function getRenseignementsMedicaux()
    {
        return $this->RenseignementsMedicaux;
    }

    public function setRenseignementsMedicaux($RenseignementsMedicaux)
    {
        $this->RenseignementsMedicaux = $RenseignementsMedicaux;

        return $this;
    }

    public function getRenseignementsGeneraux()
    {
        return $this->renseignementsGeneraux;
    }

    public function setRenseignementsGeneraux($renseignementsGeneraux)
    {
        $this->renseignementsGeneraux = $renseignementsGeneraux;

        return $this;
    }

    public function getReglement()
    {
        return $this->reglement;
    }

    public function setReglement($reglement)
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getStatuts()
    {
        return $this->statuts;
    }

    public function setStatuts($statuts)
    {
        $this->statuts = $statuts;

        return $this;
    }
}
