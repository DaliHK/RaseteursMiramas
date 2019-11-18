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
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo2;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo3;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo4;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto1()
    {
        return $this->photo1;
    }

    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2()
    {
        return $this->photo2;
    }

    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3()
    {
        return $this->photo3;
    }

    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getPhoto4()
    {
        return $this->photo4;
    }

    public function setPhoto4($photo4)
    {
        $this->photo4 = $photo4;

        return $this;
    }
}
