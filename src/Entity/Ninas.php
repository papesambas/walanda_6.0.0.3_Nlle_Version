<?php

namespace App\Entity;

use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NinasRepository;
use App\Entity\Trait\CreatedAtTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NinasRepository::class)]
class Ninas
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $designation = null;

    #[ORM\OneToOne(mappedBy: 'nina', cascade: ['persist', 'remove'])]
    private ?Peres $peres = null;

    #[ORM\OneToOne(mappedBy: 'nina', cascade: ['persist', 'remove'])]
    private ?Meres $meres = null;

    public function __toString()
    {
        return $this->designation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPeres(): ?Peres
    {
        return $this->peres;
    }

    public function setPeres(?Peres $peres): static
    {
        // unset the owning side of the relation if necessary
        if ($peres === null && $this->peres !== null) {
            $this->peres->setNina(null);
        }

        // set the owning side of the relation if necessary
        if ($peres !== null && $peres->getNina() !== $this) {
            $peres->setNina($this);
        }

        $this->peres = $peres;

        return $this;
    }

    public function getMeres(): ?Meres
    {
        return $this->meres;
    }

    public function setMeres(?Meres $meres): static
    {
        // unset the owning side of the relation if necessary
        if ($meres === null && $this->meres !== null) {
            $this->meres->setNina(null);
        }

        // set the owning side of the relation if necessary
        if ($meres !== null && $meres->getNina() !== $this) {
            $meres->setNina($this);
        }

        $this->meres = $meres;

        return $this;
    }
}
