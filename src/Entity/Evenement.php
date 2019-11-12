<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="integer")
     */
    private $nombreParticipantMax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauRequis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ParticipationEvenement", mappedBy="evenement")
     */
    private $participationEvenements;

    public function __construct()
    {
        $this->adherents = new ArrayCollection();
        $this->participationEvenements = new ArrayCollection();
    }

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

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ParticipationEvenement[]
     */
    public function getParticipationEvenements(): Collection
    {
        return $this->participationEvenements;
    }

    public function addParticipationEvenement(ParticipationEvenement $participationEvenement): self
    {
        if (!$this->participationEvenements->contains($participationEvenement)) {
            $this->participationEvenements[] = $participationEvenement;
            $participationEvenement->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipationEvenement(ParticipationEvenement $participationEvenement): self
    {
        if ($this->participationEvenements->contains($participationEvenement)) {
            $this->participationEvenements->removeElement($participationEvenement);
            // set the owning side to null (unless already changed)
            if ($participationEvenement->getEvenement() === $this) {
                $participationEvenement->setEvenement(null);
            }
        }

        return $this;
    }
    
}
