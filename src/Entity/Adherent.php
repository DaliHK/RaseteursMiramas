<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\DossierInscription;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Adherent
 * 
 * @ORM\Entity(repositoryClass="App\Repository\AdherentRepository")
 * @ORM\Table(name="adherent", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8D93D649E7927C74", columns={"username"})})
 * @UniqueEntity(
 * fields={"username"},
 * message="Username est déjà utilisé."
 * )
 * @UniqueEntity(
 * fields={"email"},
 * message="Email Inconnu !"
 * )
 */

class Adherent implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $username;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $prenom;

    /**
     * @ORM\Column(name="dateNaissance", type="datetime")
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $dateInscription;

    /**
    * @var string
    *
    * @ORM\Column(type="string", length=180, nullable=false, unique=true)
    * @Assert\NotBlank(message="Ce champ doit être rempli")
    */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroUrgence;

    /**
     * @ORM\Column(type="boolean", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cotisationAsso;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cotisationLicence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numLicence;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DossierInscription", mappedBy="adherent", cascade={"persist", "remove"})
     */
    private $dossierInscription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ParticipationEvenement", mappedBy="adherent")
     */
    private $participationEvenements;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomUrgence;

    public function __construct()
    {
        $this->evenement = new ArrayCollection();
        $this->participationEvenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    function addRole($role)
    {
        $this->roles[] = $role;
    }

    public function setRoles(array $roles): self
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @param $serialized
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNumeroUrgence(): ?int
    {
        return $this->numeroUrgence;
    }

    public function setNumeroUrgence(?int $numeroUrgence): self
    {
        $this->numeroUrgence = $numeroUrgence;

        return $this;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCotisationAsso(): ?bool
    {
        return $this->cotisationAsso;
    }

    public function setCotisationAsso(bool $cotisationAsso): self
    {
        $this->cotisationAsso = $cotisationAsso;

        return $this;
    }

    public function getCotisationLicence(): ?bool
    {
        return $this->cotisationLicence;
    }

    public function setCotisationLicence(?bool $cotisationLicence): self
    {
        $this->cotisationLicence = $cotisationLicence;

        return $this;
    }

    public function getNumLicence(): ?string
    {
        return $this->numLicence;
    }

    public function setNumLicence(?string $numLicence): self
    {
        $this->numLicence = $numLicence;

        return $this;
    }

    public function getDossierInscription(): ?DossierInscription
    {
        return $this->dossierInscription;
    }

    public function setDossierInscription(DossierInscription $dossierInscription): self
    {
        $this->dossierInscription = $dossierInscription;

        // set the owning side of the relation if necessary
        if ($dossierInscription->getAdherent() !== $this) {
            $dossierInscription->setAdherent($this);
        }

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
            $participationEvenement->setAdherent($this);
        }

        return $this;
    }

    public function removeParticipationEvenement(ParticipationEvenement $participationEvenement): self
    {
        if ($this->participationEvenements->contains($participationEvenement)) {
            $this->participationEvenements->removeElement($participationEvenement);
            // set the owning side to null (unless already changed)
            if ($participationEvenement->getAdherent() === $this) {
                $participationEvenement->setAdherent(null);
            }
        }

        return $this;
    }

    public function getNiveau(): ?bool
    {
        return $this->niveau;
    }

    public function setNiveau(?bool $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getNomUrgence(): ?string
    {
        return $this->NomUrgence;
    }

    public function setNomUrgence(?string $NomUrgence): self
    {
        $this->NomUrgence = $NomUrgence;

        return $this;
    }
}


