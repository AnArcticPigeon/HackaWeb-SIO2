<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, name:'dateDeb')]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATE_MUTABLE , name:'dateFin')]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, name:'dateLimit')]
    private ?\DateTimeInterface $DateLimit = null;

    #[ORM\ManyToOne(inversedBy: 'lesEvenement')]
    private ?Hackaton $leHackaton = null;



    public function __construct()
    {
        
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
        return $this->DateLimit;
    }

    public function setDateLimit(\DateTimeInterface $DateLimit): static
    {
        $this->DateLimit = $DateLimit;

        return $this;
    }

    public function getLeHackaton(): ?Hackaton
    {
        return $this->leHackaton;
    }

    public function setLeHackaton(?Hackaton $leHackaton): static
    {
        $this->leHackaton = $leHackaton;

        return $this;
    }

    
}
