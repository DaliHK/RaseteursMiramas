<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarouselPictureRepository")
 */
class CarouselPicture
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
    private $photo1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo6;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto1()
    {
        return $this->photo1;
    }

    public function setPhoto1( $photo1)
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

    public function getPhoto5()
    {
        return $this->photo5;
    }

    public function setPhoto5($photo5)
    {
        $this->photo5 = $photo5;

        return $this;
    }

    public function getPhoto6()
    {
        return $this->photo6;
    }

    public function setPhoto6($photo6)
    {
        $this->photo6 = $photo6;

        return $this;
    }
}
