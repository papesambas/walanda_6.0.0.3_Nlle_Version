<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\Scolarites1Repository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: Scolarites1Repository::class)]
class Scolarites1
{
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $scolarite = null;

    #[ORM\ManyToOne(inversedBy: 'scolarites1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveaux $niveau = null;

    #[ORM\OneToMany(mappedBy: 'scolarite1', targetEntity: Scolarites2::class)]
    private Collection $scolarites2s;

    #[ORM\OneToMany(mappedBy: 'scolarite1', targetEntity: Redoublements1::class)]
    private Collection $redoublements1s;

    #[ORM\OneToMany(mappedBy: 'scolarite1', targetEntity: Redoublements2::class)]
    private Collection $redoublements2s;

    #[ORM\OneToMany(mappedBy: 'scolarite1', targetEntity: Redoublements3::class)]
    private Collection $redoublements3s;

    #[ORM\OneToMany(mappedBy: 'scolarite1', targetEntity: Eleves::class)]
    private Collection $eleves;

    public function __construct()
    {
        $this->scolarites2s = new ArrayCollection();
        $this->redoublements1s = new ArrayCollection();
        $this->redoublements2s = new ArrayCollection();
        $this->redoublements3s = new ArrayCollection();
        $this->eleves = new ArrayCollection();
    }

    public function __toString()
    {
        return strval($this->scolarite);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScolarite(): ?int
    {
        return $this->scolarite;
    }

    public function setScolarite(int $scolarite): static
    {
        $this->scolarite = $scolarite;

        return $this;
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

    /**
     * @return Collection<int, Scolarites2>
     */
    public function getScolarites2s(): Collection
    {
        return $this->scolarites2s;
    }

    public function addScolarites2(Scolarites2 $scolarites2): static
    {
        if (!$this->scolarites2s->contains($scolarites2)) {
            $this->scolarites2s->add($scolarites2);
            $scolarites2->setScolarite1($this);
        }

        return $this;
    }

    public function removeScolarites2(Scolarites2 $scolarites2): static
    {
        if ($this->scolarites2s->removeElement($scolarites2)) {
            // set the owning side to null (unless already changed)
            if ($scolarites2->getScolarite1() === $this) {
                $scolarites2->setScolarite1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Redoublements1>
     */
    public function getRedoublements1s(): Collection
    {
        return $this->redoublements1s;
    }

    public function addRedoublements1(Redoublements1 $redoublements1): static
    {
        if (!$this->redoublements1s->contains($redoublements1)) {
            $this->redoublements1s->add($redoublements1);
            $redoublements1->setScolarite1($this);
        }

        return $this;
    }

    public function removeRedoublements1(Redoublements1 $redoublements1): static
    {
        if ($this->redoublements1s->removeElement($redoublements1)) {
            // set the owning side to null (unless already changed)
            if ($redoublements1->getScolarite1() === $this) {
                $redoublements1->setScolarite1(null);
            }
        }

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
            $redoublements2->setScolarite1($this);
        }

        return $this;
    }

    public function removeRedoublements2(Redoublements2 $redoublements2): static
    {
        if ($this->redoublements2s->removeElement($redoublements2)) {
            // set the owning side to null (unless already changed)
            if ($redoublements2->getScolarite1() === $this) {
                $redoublements2->setScolarite1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Redoublements3>
     */
    public function getRedoublements3s(): Collection
    {
        return $this->redoublements3s;
    }

    public function addRedoublements3(Redoublements3 $redoublements3): static
    {
        if (!$this->redoublements3s->contains($redoublements3)) {
            $this->redoublements3s->add($redoublements3);
            $redoublements3->setScolarite1($this);
        }

        return $this;
    }

    public function removeRedoublements3(Redoublements3 $redoublements3): static
    {
        if ($this->redoublements3s->removeElement($redoublements3)) {
            // set the owning side to null (unless already changed)
            if ($redoublements3->getScolarite1() === $this) {
                $redoublements3->setScolarite1(null);
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
            $elefe->setScolarite1($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getScolarite1() === $this) {
                $elefe->setScolarite1(null);
            }
        }

        return $this;
    }
}
