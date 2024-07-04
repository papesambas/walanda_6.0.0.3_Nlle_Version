<?php

namespace App\Entity;

use App\Repository\Redoublements1Repository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: Redoublements1Repository::class)]
class Redoublements1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveaux $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s')]
    private ?Scolarites1 $scolarite1 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s')]
    private ?Scolarites2 $scolarite2 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s')]
    private ?Scolarites3 $scolarite3 = null;

    #[ORM\OneToMany(mappedBy: 'redoublement1', targetEntity: Redoublements2::class)]
    private Collection $redoublements2s;

    #[ORM\OneToMany(mappedBy: 'redoublement1', targetEntity: Eleves::class)]
    private Collection $eleves;

    public function __construct()
    {
        $this->redoublements2s = new ArrayCollection();
        $this->eleves = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->niveau->getDesignation();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?Niveaux
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveaux $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getScolarite1(): ?Scolarites1
    {
        return $this->scolarite1;
    }

    public function setScolarite1(?Scolarites1 $scolarite1): static
    {
        $this->scolarite1 = $scolarite1;

        return $this;
    }

    public function getScolarite2(): ?Scolarites2
    {
        return $this->scolarite2;
    }

    public function setScolarite2(?Scolarites2 $scolarite2): static
    {
        $this->scolarite2 = $scolarite2;

        return $this;
    }

    public function getScolarite3(): ?Scolarites3
    {
        return $this->scolarite3;
    }

    public function setScolarite3(?Scolarites3 $scolarite3): static
    {
        $this->scolarite3 = $scolarite3;

        return $this;
    }

    /**
     * @return Collection<int, Redoublements2>
     */
    public function getRedoublements2s(): Collection
    {
        return $this->redoublements2s;
    }

    public function addRedoublements2(Redoublements2 $redoublements2): static
    {
        if (!$this->redoublements2s->contains($redoublements2)) {
            $this->redoublements2s->add($redoublements2);
            $redoublements2->setRedoublement1($this);
        }

        return $this;
    }

    public function removeRedoublements2(Redoublements2 $redoublements2): static
    {
        if ($this->redoublements2s->removeElement($redoublements2)) {
            // set the owning side to null (unless already changed)
            if ($redoublements2->getRedoublement1() === $this) {
                $redoublements2->setRedoublement1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleves $elefe): static
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->setRedoublement1($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getRedoublement1() === $this) {
                $elefe->setRedoublement1(null);
            }
        }

        return $this;
    }
}
