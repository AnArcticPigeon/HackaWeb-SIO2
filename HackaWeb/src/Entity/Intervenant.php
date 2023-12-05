<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantRepository::class)]
class Intervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'lIntervenant', targetEntity: Conference::class)]
    private Collection $lesConference;

    public function __construct()
    {
        $this->lesConference = new ArrayCollection();
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

    /**
     * @return Collection<int, Conference>
     */
    public function getLesConference(): Collection
    {
        return $this->lesConference;
    }

    public function addLesConference(Conference $lesConference): static
    {
        if (!$this->lesConference->contains($lesConference)) {
            $this->lesConference->add($lesConference);
            $lesConference->setLIntervenant($this);
        }

        return $this;
    }

    public function removeLesConference(Conference $lesConference): static
    {
        if ($this->lesConference->removeElement($lesConference)) {
            // set the owning side to null (unless already changed)
            if ($lesConference->getLIntervenant() === $this) {
                $lesConference->setLIntervenant(null);
            }
        }

        return $this;
    }
}
