<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adherent", inversedBy="participations")
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="participations")
     */
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setIdAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getIdEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setIdEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
