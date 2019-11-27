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
    private $titre;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }


}
