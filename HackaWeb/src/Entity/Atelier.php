<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier extends Evenement
{
    #[ORM\Column(name:'nbPlace')]
    private ?int $nbPlace = null;

    #[ORM\OneToMany(mappedBy: 'lAtelier', targetEntity: Participant::class)]
    private Collection $lesParticipant;

    public function __construct()
    {
        parent::__construct();
        $this->lesParticipant = new ArrayCollection();
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

    /**
     * @return Collection<int, Participant>
     */
    public function getLesParticipant(): Collection
    {
        return $this->lesParticipant;
    }

    public function addLesParticipant(Participant $lesParticipant): static
    {
        if (!$this->lesParticipant->contains($lesParticipant)) {
            $this->lesParticipant->add($lesParticipant);
            $lesParticipant->setLAtelier($this);
        }

        return $this;
    }

    public function removeLesParticipant(Participant $lesParticipant): static
    {
        if ($this->lesParticipant->removeElement($lesParticipant)) {
            // set the owning side to null (unless already changed)
            if ($lesParticipant->getLAtelier() === $this) {
                $lesParticipant->setLAtelier(null);
            }
        }

        return $this;
    }

}
    