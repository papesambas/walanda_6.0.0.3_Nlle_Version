<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\ElevesRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ElevesRepository::class)]
class Eleves
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'eleves_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 50)]
    private ?string $matricule = null;

    #[ORM\Column(length: 8)]
    private ?string $sexe = "Masculin";

    #[ORM\Column(length: 8)]
    private ?string $statutFinance = "Privé";

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateExtrait = null;

    #[ORM\Column(length: 30)]
    private ?string $numExtrait = null;

    #[ORM\Column]
    private ?bool $isAdmis = false;

    #[ORM\Column]
    private ?bool $isActif = false;

    #[ORM\Column]
    private ?bool $isHandicap = false;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $natureHandicap = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRecrutement = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Noms $nom = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prenoms $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuNaissances $lieuNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classes $classe = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Statuts $statut = null;

    #[ORM\ManyToOne(inversedBy: 'elevesAnDernier')]
    private ?EcoleProvenances $ecoleAnDernier = null;

    #[ORM\ManyToOne(inversedBy: 'elevesRecrutement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EcoleProvenances $ecoleRecrutement = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Departements $departement = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Scolarites1 $scolarite1 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Scolarites2 $scolarite2 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Scolarites3 $scolarite3 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Redoublements1 $redoublement1 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Redoublements2 $redoublement2 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Redoublements3 $redoublement3 = null;

    #[ORM\OneToOne(inversedBy: 'eleves', cascade: ['persist', 'remove'])]
    #[Assert\Valid]

    private ?Users $user = null;

    #[ORM\OneToMany(mappedBy: 'eleves', targetEntity: DossierEleves::class, cascade: ['persist', 'remove'])]
    private Collection $dossier;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parents $parent = null;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Santes::class, orphanRemoval: true, cascade: ['persist'])]
    #[Assert\Count(max: 3)]

    private Collection $santes;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Departs::class, cascade: ['persist'])]
    private Collection $departs;

    #[ORM\OneToOne(inversedBy: 'eleves', cascade: ['persist', 'remove'])]
    private ?FraisScolarites $fraisScolarite = null;

    public function __construct()
    {
        $this->dossier = new ArrayCollection();
        $this->santes = new ArrayCollection();
        $this->departs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->fullname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe($sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getStatutFinance(): ?string
    {
        return $this->statutFinance;
    }

    public function setStatutFinance($statutFinance): static
    {
        $this->statutFinance = $statutFinance;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateExtrait(): ?\DateTimeInterface
    {
        return $this->dateExtrait;
    }

    public function setDateExtrait($dateExtrait): static
    {
        $this->dateExtrait = $dateExtrait;

        return $this;
    }

    public function getNumExtrait(): ?string
    {
        return $this->numExtrait;
    }

    public function setNumExtrait($numExtrait): static
    {
        $this->numExtrait = $numExtrait;

        return $this;
    }

    public function isIsAdmis(): ?bool
    {
        return $this->isAdmis;
    }

    public function setIsAdmis(bool $isAdmis): static
    {
        $this->isAdmis = $isAdmis;

        return $this;
    }

    public function isIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): static
    {
        $this->isActif = $isActif;

        return $this;
    }

    public function isIsHandicap(): ?bool
    {
        return $this->isHandicap;
    }

    public function setIsHandicap(bool $isHandicap): static
    {
        $this->isHandicap = $isHandicap;

        return $this;
    }

    public function getNatureHandicap(): ?string
    {
        return $this->natureHandicap;
    }

    public function setNatureHandicap(?string $natureHandicap): static
    {
        $this->natureHandicap = $natureHandicap;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription($dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getDateRecrutement(): ?\DateTimeInterface
    {
        return $this->dateRecrutement;
    }

    public function setDateRecrutement($dateRecrutement): static
    {
        $this->dateRecrutement = $dateRecrutement;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;

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

    public function getNom(): ?Noms
    {
        return $this->nom;
    }

    public function setNom(?Noms $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?Prenoms
    {
        return $this->prenom;
    }

    public function setPrenom(?Prenoms $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLieuNaissance(): ?LieuNaissances
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?LieuNaissances $lieuNaissance): static
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getClasse(): ?Classes
    {
        return $this->classe;
    }

    public function setClasse(?Classes $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getStatut(): ?Statuts
    {
        return $this->statut;
    }

    public function setStatut(?Statuts $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEcoleAnDernier(): ?EcoleProvenances
    {
        return $this->ecoleAnDernier;
    }

    public function setEcoleAnDernier(?EcoleProvenances $ecoleAnDernier): static
    {
        $this->ecoleAnDernier = $ecoleAnDernier;

        return $this;
    }

    public function getEcoleRecrutement(): ?EcoleProvenances
    {
        return $this->ecoleRecrutement;
    }

    public function setEcoleRecrutement(?EcoleProvenances $ecoleRecrutement): static
    {
        $this->ecoleRecrutement = $ecoleRecrutement;

        return $this;
    }

    public function getDepartement(): ?Departements
    {
        return $this->departement;
    }

    public function setDepartement(?Departements $departement): static
    {
        $this->departement = $departement;

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

    public function getRedoublement1(): ?Redoublements1
    {
        return $this->redoublement1;
    }

    public function setRedoublement1(?Redoublements1 $redoublement1): static
    {
        $this->redoublement1 = $redoublement1;

        return $this;
    }

    public function getRedoublement2(): ?Redoublements2
    {
        return $this->redoublement2;
    }

    public function setRedoublement2(?Redoublements2 $redoublement2): static
    {
        $this->redoublement2 = $redoublement2;

        return $this;
    }

    public function getRedoublement3(): ?Redoublements3
    {
        return $this->redoublement3;
    }

    public function setRedoublement3(?Redoublements3 $redoublement3): static
    {
        $this->redoublement3 = $redoublement3;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, DossierEleves>
     */
    public function getDossier(): Collection
    {
        return $this->dossier;
    }

    public function addDossier(DossierEleves $dossier): static
    {
        if (!$this->dossier->contains($dossier)) {
            $this->dossier->add($dossier);
            $dossier->setEleves($this);
        }

        return $this;
    }

    public function removeDossier(DossierEleves $dossier): static
    {
        if ($this->dossier->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getEleves() === $this) {
                $dossier->setEleves(null);
            }
        }

        return $this;
    }

    public function getParent(): ?Parents
    {
        return $this->parent;
    }

    public function setParent(?Parents $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return Collection<int, Santes>
     */
    public function getSantes(): Collection
    {
        return $this->santes;
    }

    public function addSante(Santes $sante): static
    {
        if (!$this->santes->contains($sante)) {
            $this->santes->add($sante);
            $sante->setEleve($this);
        }

        return $this;
    }

    public function removeSante(Santes $sante): static
    {
        if ($this->santes->removeElement($sante)) {
            // set the owning side to null (unless already changed)
            if ($sante->getEleve() === $this) {
                $sante->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Departs>
     */
    public function getDeparts(): Collection
    {
        return $this->departs;
    }

    public function addDepart(Departs $depart): static
    {
        if (!$this->departs->contains($depart)) {
            $this->departs->add($depart);
            $depart->setEleve($this);
        }

        return $this;
    }

    public function removeDepart(Departs $depart): static
    {
        if ($this->departs->removeElement($depart)) {
            // set the owning side to null (unless already changed)
            if ($depart->getEleve() === $this) {
                $depart->setEleve(null);
            }
        }

        return $this;
    }

    public function getFraisScolarite(): ?FraisScolarites
    {
        return $this->fraisScolarite;
    }

    public function setFraisScolarite(?FraisScolarites $fraisScolarite): static
    {
        $this->fraisScolarite = $fraisScolarite;

        return $this;
    }
}
