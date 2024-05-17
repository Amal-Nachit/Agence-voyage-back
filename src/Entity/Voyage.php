<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
        'api_voyage_index',
        'api_voyage_show'
    ])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    private ?string $destination = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups([
        'api_voyage_index'
    ])]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    private ?string $image = null;

    #[ORM\Column(length: 100)]
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    private ?string $prix = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'voyages')]
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    private Collection $voyage;

    /**
     * @var Collection<int, Pays>
     */
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    #[ORM\ManyToMany(targetEntity: Pays::class, inversedBy: 'voyages')]
    private Collection $pays;

    #[ORM\ManyToOne(inversedBy: 'voyages')]
    private ?User $user = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[Groups(['api_voyage_index', 'api_voyage_show'])]
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'voyage')]
    private Collection $categorie;

    public function __construct()
    {
        $this->pays = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getVoyage(): Collection
    {
        return $this->voyage;
    }

    public function addVoyage(Categorie $voyage): static
    {
        if (!$this->voyage->contains($voyage)) {
            $this->voyage->add($voyage);
        }

        return $this;
    }

    public function removeVoyage(Categorie $voyage): static
    {
        $this->voyage->removeElement($voyage);

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
        }

        return $this;
    }

    public function removePay(Pays $pay): static
    {
        $this->pays->removeElement($pay);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }
}
