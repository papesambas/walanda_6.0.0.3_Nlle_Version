<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CerclesRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CerclesRepository::class)]
#[UniqueEntity(fields: ['designation'], message: "Cette désignation existe déjà")]

class Cercles
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, unique: true)]
    #[Assert\NotBlank()]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'cercles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Regions $region = null;

    #[ORM\OneToMany(mappedBy: 'cercle', targetEntity: Communes::class)]
    private Collection $communes;

    public function __construct()
    {
        $this->communes = new ArrayCollection();
    }

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

    public function getRegion(): ?Regions
    {
        return $this->region;
    }

    public function setRegion(?Regions $region): static
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, Communes>
     */
    public function getCommunes(): Collection
    {
        return $this->communes;
    }

    public function addCommune(Communes $commune): static
    {
        if (!$this->communes->contains($commune)) {
            $this->communes->add($commune);
            $commune->setCercle($this);
        }

        return $this;
    }

    public function removeCommune(Communes $commune): static
    {
        if ($this->communes->removeElement($commune)) {
            // set the owning side to null (unless already changed)
            if ($commune->getCercle() === $this) {
                $commune->setCercle(null);
            }
        }

        return $this;
    }
}
