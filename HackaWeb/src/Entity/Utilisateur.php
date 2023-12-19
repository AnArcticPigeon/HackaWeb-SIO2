<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity('email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "json")]
    private $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true, name:'dateNaiss')]
    private ?\DateTimeInterface $dateNaiss = null;

    #[ORM\ManyToMany(targetEntity: Equipe::class, inversedBy: 'lesUtilisateur')]
    private Collection $lesEquipe;

    public function __construct()
    {
        $this->lesHackaton = new ArrayCollection();
        $this->lesEquipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDateNaiss(): ?DateTime
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?DateTime $dateNaiss): static
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

     //partie Authentification / permisions
     public function getUserIdentifier(): string
     {
         return (string) $this->email;
     }
 
     public function getRoles(): array
     {
         $roles = $this->roles;
         // guarantee every user at least has ROLE_USER
         $roles[] = 'ROLE_USER';
         return array_unique($roles);
     }
 
     public function setRoles(array $roles): self
     {
         $this->roles = $roles;
         return $this;
     }
 
     public function eraseCredentials()
     {
     // If you store any temporary, sensitive data on the user, clear it here
     // $this->plainPassword = null;
     } 

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setPassword(string $password): self
    {
        $this->mdp = $password;
        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getLesEquipe(): Collection
    {
        return $this->lesEquipe;
    }

    public function addLesEquipe(Equipe $lesEquipe): static
    {
        if (!$this->lesEquipe->contains($lesEquipe)) {
            $this->lesEquipe->add($lesEquipe);
        }

        return $this;
    }

    public function removeLesEquipe(Equipe $lesEquipe): static
    {
        $this->lesEquipe->removeElement($lesEquipe);

        return $this;
    }

}
