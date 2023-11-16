<?php

namespace App\Entity;

use App\Repository\ConferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]
class Conference extends Evenement
{

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\ManyToOne(inversedBy: 'lesConference')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Intervenant $lintervenant = null;

  
    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getLintervenant(): ?Intervenant
    {
        return $this->lintervenant;
    }

    public function setLintervenant(?Intervenant $lintervenant): static
    {
        $this->lintervenant = $lintervenant;

        return $this;
    }
}
