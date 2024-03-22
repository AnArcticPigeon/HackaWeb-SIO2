<?php

namespace App\Entity;

use App\Repository\HackatonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HackatonRepository::class)]
class Hackaton
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, name:'dateDeb')]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATE_MUTABLE , name:'dateFin')]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column ( name:'nbPlace')]
    private ?int $nbPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\Column(length: 255)]
    private ?string $addresse = null;

    #[ORM\OneToMany(mappedBy: 'leHackaton', targetEntity: Evenement::class )]
    private Collection $lesEvenement;

    #[ORM\OneToMany(mappedBy: 'leHackaton', targetEntity: Equipe::class)]
    private Collection $lesequipe;

    #[ORM\JoinColumn(name: "idVille", referencedColumnName :"id")]
    #[ORM\ManyToOne(inversedBy: 'lesHackaton')]
    private ?Ville $laVille = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true,name:'dateLimit')]
    private ?\DateTimeInterface $DateLimit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    

    

    public function __construct()
    {
        $this->lesUtilisateur = new ArrayCollection();
        $this->lesEvenement = new ArrayCollection();
        $this->lesAtelier = new ArrayCollection();
        $this->lesequipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(int $nbPlace): static
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): static
    {
        $this->addresse = $addresse;

        return $this;
    }

    

    /**
     * @return Collection<int, Evenement>
     */
    public function getLesEvenement(): Collection
    {
        return $this->lesEvenement;
    }

    public function addLesEvenement(Evenement $lesEvenement): static
    {
        if (!$this->lesEvenement->contains($lesEvenement)) {
            $this->lesEvenement->add($lesEvenement);
            $lesEvenement->setLeHackaton($this);
        }

        return $this;
    }

    public function removeLesEvenement(Evenement $lesEvenement): static
    {
        if ($this->lesEvenement->removeElement($lesEvenement)) {
            // set the owning side to null (unless already changed)
            if ($lesEvenement->getLeHackaton() === $this) {
                $lesEvenement->setLeHackaton(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getLesequipe(): Collection
    {
        return $this->lesequipe;
    }

    public function addLesequipe(Equipe $lesequipe): static
    {
        if (!$this->lesequipe->contains($lesequipe)) {
            $this->lesequipe->add($lesequipe);
            $lesequipe->setLeHackaton($this);
        }

        return $this;
    }

    public function removeLesequipe(Equipe $lesequipe): static
    {
        if ($this->lesequipe->removeElement($lesequipe)) {
            // set the owning side to null (unless already changed)
            if ($lesequipe->getLeHackaton() === $this) {
                $lesequipe->setLeHackaton(null);
            }
        }

        return $this;
    }

    public function getLaVille(): ?Ville
    {
        return $this->laVille;
    }

    public function setLaVille(?Ville $laVille): static
    {
        $this->laVille = $laVille;

        return $this;
    }

    public function getDateLimit(): ?\DateTimeInterface
    {
        return $this->DateLimit;
    }

    public function setDateLimit(?\DateTimeInterface $DateLimit): static
    {
        $this->DateLimit = $DateLimit;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    

 
}
