<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourcePhotoRepository")
 */
class SourcePhoto
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
    private $vieEcole;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $courseCamarguaise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $illustrationAgenda;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVieEcole(): ?string
    {
        return $this->vieEcole;
    }

    public function setVieEcole(string $vieEcole): self
    {
        $this->vieEcole = $vieEcole;

        return $this;
    }

    public function getCourseCamarguaise(): ?string
    {
        return $this->courseCamarguaise;
    }

    public function setCourseCamarguaise(string $courseCamarguaise): self
    {
        $this->courseCamarguaise = $courseCamarguaise;

        return $this;
    }

    public function getIllustrationAgenda(): ?string
    {
        return $this->illustrationAgenda;
    }

    public function setIllustrationAgenda(string $illustrationAgenda): self
    {
        $this->illustrationAgenda = $illustrationAgenda;

        return $this;
    }
}
