<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomEquipe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInsc = null;

    #[ORM\Column(length: 255)]
    private ?string $numInsc = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'lesEquipe')]
    private Collection $lesUtilisateur;

    public function __construct()
    {
        $this->lesUtilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(string $nomEquipe): static
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    public function getDateInsc(): ?\DateTimeInterface
    {
        return $this->dateInsc;
    }

    public function setDateInsc(\DateTimeInterface $dateInsc): static
    {
        $this->dateInsc = $dateInsc;

        return $this;
    }

    public function getNumInsc(): ?string
    {
        return $this->numInsc;
    }

    public function setNumInsc(string $numInsc): static
    {
        $this->numInsc = $numInsc;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getLesUtilisateur(): Collection
    {
        return $this->lesUtilisateur;
    }

    public function addLesUtilisateur(Utilisateur $lesUtilisateur): static
    {
        if (!$this->lesUtilisateur->contains($lesUtilisateur)) {
            $this->lesUtilisateur->add($lesUtilisateur);
            $lesUtilisateur->addLesEquipe($this);
        }

        return $this;
    }

    public function removeLesUtilisateur(Utilisateur $lesUtilisateur): static
    {
        if ($this->lesUtilisateur->removeElement($lesUtilisateur)) {
            $lesUtilisateur->removeLesEquipe($this);
        }

        return $this;
    }
}
