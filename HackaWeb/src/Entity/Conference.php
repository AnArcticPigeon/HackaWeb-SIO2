<?php

namespace App\Entity;

use App\Repository\ConferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]
class Conference extends Evenement
{

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\JoinColumn(name: "idIntervenant", referencedColumnName :"id")]
    #[ORM\ManyToOne(inversedBy: 'lesConference' )]
    private ?Intervenant $lIntervenant = null;


  
    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getLIntervenant(): ?Intervenant
    {
        return $this->lIntervenant;
    }

    public function setLIntervenant(?Intervenant $lIntervenant): static
    {
        $this->lIntervenant = $lIntervenant;

        return $this;
    }

   
}
