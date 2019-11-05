<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="date")
     */
    private $nombreParticipantMax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauRequis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionEvenement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Participation", mappedBy="idEvenement", cascade={"persist", "remove"})
     */
    private $participation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(string $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNombreParticipantMax(): ?int
    {
        return $this->nombreParticipantMax;
    }

    public function setNombreParticipantMax(int $nombreParticipantMax): self
    {
        $this->nombreParticipantMax = $nombreParticipantMax;

        return $this;
    }

    public function getNiveauRequis(): ?string
    {
        return $this->niveauRequis;
    }

    public function setNiveauRequis(string $niveauRequis): self
    {
        $this->niveauRequis = $niveauRequis;

        return $this;
    }

    public function getDescriptionEvenement(): ?string
    {
        return $this->descriptionEvenement;
    }

    public function setDescriptionEvenement(string $descriptionEvenement): self
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getParticipation(): ?Participation
    {
        return $this->participation;
    }

    public function setParticipation(?Participation $participation): self
    {
        $this->participation = $participation;

        // set (or unset) the owning side of the relation if necessary
        $newIdEvenement = null === $participation ? null : $this;
        if ($participation->getIdEvenement() !== $newIdEvenement) {
            $participation->setIdEvenement($newIdEvenement);
        }

        return $this;
    }
}
