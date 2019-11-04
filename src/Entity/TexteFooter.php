<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TexteFooterRepository")
 */
class TexteFooter
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
    private $section2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section4;

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

    public function getSection2(): ?string
    {
        return $this->section2;
    }

    public function setSection2(?string $section2): self
    {
        $this->section2 = $section2;

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

    public function getSection4(): ?string
    {
        return $this->section4;
    }

    public function setSection4(?string $section4): self
    {
        $this->section4 = $section4;

        return $this;
    }
}
