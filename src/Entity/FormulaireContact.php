<?php

namespace App\Entity;

use App\Repository\FormulaireContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FormulaireContactRepository::class)]
class FormulaireContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Groups([
        'api_formulaire_index',
        'api_formulaire_show'
    ])]

    #[ORM\Column]
    private ?int $nbPlaces = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([
        'api_formulaire_index',
        'api_formulaire_show'
    ])]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'formulaireContact')]
    #[Groups([
        'api_formulaire_index',
        'api_formulaire_show'
    ])]
    private ?Voyage $voyage = null;

    #[ORM\ManyToOne(inversedBy: 'formulaireContact')]
    private ?Statut $statut = null;
    #[Groups([
        'api_formulaire_index',
        'api_formulaire_show'
    ])]

    #[ORM\ManyToOne(inversedBy: 'formulaireContact')]
    private ?User $user = null;
    #[Groups([
        'api_formulaire_index',
        'api_formulaire_show'
    ])]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): static
    {
        $this->voyage = $voyage;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

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
}
