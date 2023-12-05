<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $cp = null;

    #[ORM\OneToMany(mappedBy: 'laVille', targetEntity: Hackaton::class)]
    private Collection $lesHackaton;

    public function __construct()
    {
        $this->lesHackaton = new ArrayCollection();
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

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection<int, Hackaton>
     */
    public function getLesHackaton(): Collection
    {
        return $this->lesHackaton;
    }

    public function addLesHackaton(Hackaton $lesHackaton): static
    {
        if (!$this->lesHackaton->contains($lesHackaton)) {
            $this->lesHackaton->add($lesHackaton);
            $lesHackaton->setLaVille($this);
        }

        return $this;
    }

    public function removeLesHackaton(Hackaton $lesHackaton): static
    {
        if ($this->lesHackaton->removeElement($lesHackaton)) {
            // set the owning side to null (unless already changed)
            if ($lesHackaton->getLaVille() === $this) {
                $lesHackaton->setLaVille(null);
            }
        }

        return $this;
    }
}
