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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLimit = null;

    #[ORM\Column]
    private ?int $nbPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\Column(length: 255)]
    private ?string $addresse = null;

    #[ORM\OneToMany(mappedBy: 'leHackaton', targetEntity: Evenement::class)]
    private Collection $lesEvenement;

    

    

    public function __construct()
    {
        $this->lesUtilisateur = new ArrayCollection();
        $this->lesEvenement = new ArrayCollection();
        $this->lesAtelier = new ArrayCollection();
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

    public function getDateLimit(): ?\DateTimeInterface
    {
        return $this->dateLimit;
    }

    public function setDateLimit(\DateTimeInterface $dateLimit): static
    {
        $this->dateLimit = $dateLimit;

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

    

 
}
