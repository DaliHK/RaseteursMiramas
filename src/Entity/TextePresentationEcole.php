<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TextePresentationEcoleRepository")
 */
class TextePresentationEcole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection1(): ?string
    {
        return $this->section1;
    }

    public function setSection1(?string $section1): self
    {
        $this->section1 = $section1;

        return $this;
    }

    public function getSection3(): ?string
    {
        return $this->section3;
    }

    public function setSection3(?string $section3): self
    {
        $this->section3 = $section3;

        return $this;
    }
}
