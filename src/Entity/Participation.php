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
    private $id_adherent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="participations")
     */
    private $id_evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAdherent(): ?Adherent
    {
        return $this->id_adherent;
    }

    public function setIdAdherent(?Adherent $id_adherent): self
    {
        $this->id_adherent = $id_adherent;

        return $this;
    }

    public function getIdEvenement(): ?Evenement
    {
        return $this->id_evenement;
    }

    public function setIdEvenement(?Evenement $id_evenement): self
    {
        $this->id_evenement = $id_evenement;

        return $this;
    }
}
