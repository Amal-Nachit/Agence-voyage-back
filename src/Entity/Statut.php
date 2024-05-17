<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $intitule = null;

    /**
     * @var Collection<int, FormulaireContact>
     */
    #[ORM\OneToMany(targetEntity: FormulaireContact::class, mappedBy: 'statut')]
    private Collection $formulaireContact;

    public function __construct()
    {
        $this->formulaireContact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection<int, FormulaireContact>
     */
    public function getFormulaireContact(): Collection
    {
        return $this->formulaireContact;
    }

    public function addFormulaireContact(FormulaireContact $formulaireContact): static
    {
        if (!$this->formulaireContact->contains($formulaireContact)) {
            $this->formulaireContact->add($formulaireContact);
            $formulaireContact->setStatut($this);
        }

        return $this;
    }

    public function removeFormulaireContact(FormulaireContact $formulaireContact): static
    {
        if ($this->formulaireContact->removeElement($formulaireContact)) {
            // set the owning side to null (unless already changed)
            if ($formulaireContact->getStatut() === $this) {
                $formulaireContact->setStatut(null);
            }
        }

        return $this;
    }
}
