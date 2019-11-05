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
     * @ORM\OneToOne(targetEntity="App\Entity\Adherent", inversedBy="participation", cascade={"persist", "remove"})
     */
    private $idAdherent;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Evenement", inversedBy="participation", cascade={"persist", "remove"})
     */
    private $idEvenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAdherent(): ?adherent
    {
        return $this->idAdherent;
    }

    public function setIdAdherent(?adherent $idAdherent): self
    {
        $this->idAdherent = $idAdherent;

        return $this;
    }

    public function getIdEvenement(): ?evenement
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(?evenement $idEvenement): self
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }
}
