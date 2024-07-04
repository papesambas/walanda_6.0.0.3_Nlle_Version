<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\EcoleProvenancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: EcoleProvenancesRepository::class)]
#[UniqueEntity(fields: ['designation'], message: "Cette désignation existe déjà")]
class EcoleProvenances
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, unique:true)]
    private ?string $designation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'ecoleAnDernier', targetEntity: Eleves::class)]
    private Collection $elevesAnDernier;

    #[ORM\OneToMany(mappedBy: 'ecoleRecrutement', targetEntity: Eleves::class)]
    #[Assert\NotBlank]
    private Collection $elevesRecrutement;

    public function __construct()
    {
        $this->elevesAnDernier = new ArrayCollection();
        $this->elevesRecrutement = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getElevesAnDernier(): Collection
    {
        return $this->elevesAnDernier;
    }

    public function addElevesAnDernier(Eleves $elevesAnDernier): static
    {
        if (!$this->elevesAnDernier->contains($elevesAnDernier)) {
            $this->elevesAnDernier->add($elevesAnDernier);
            $elevesAnDernier->setEcoleAnDernier($this);
        }

        return $this;
    }

    public function removeElevesAnDernier(Eleves $elevesAnDernier): static
    {
        if ($this->elevesAnDernier->removeElement($elevesAnDernier)) {
            // set the owning side to null (unless already changed)
            if ($elevesAnDernier->getEcoleAnDernier() === $this) {
                $elevesAnDernier->setEcoleAnDernier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getElevesRecrutement(): Collection
    {
        return $this->elevesRecrutement;
    }

    public function addElevesRecrutement(Eleves $elevesRecrutement): static
    {
        if (!$this->elevesRecrutement->contains($elevesRecrutement)) {
            $this->elevesRecrutement->add($elevesRecrutement);
            $elevesRecrutement->setEcoleRecrutement($this);
        }

        return $this;
    }

    public function removeElevesRecrutement(Eleves $elevesRecrutement): static
    {
        if ($this->elevesRecrutement->removeElement($elevesRecrutement)) {
            // set the owning side to null (unless already changed)
            if ($elevesRecrutement->getEcoleRecrutement() === $this) {
                $elevesRecrutement->setEcoleRecrutement(null);
            }
        }

        return $this;
    }
}
