<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Contenu = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $Auteur = null;

    #[ORM\Column]
    private ?bool $EstPublie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateValidation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): static
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $DateCreation): static
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): static
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function isEstPublie(): ?bool
    {
        return $this->EstPublie;
    }

    public function setEstPublie(bool $EstPublie): static
    {
        $this->EstPublie = $EstPublie;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->DateValidation;
    }

    public function setDateValidation(?\DateTimeInterface $DateValidation): static
    {
        $this->DateValidation = $DateValidation;

        return $this;
    }
}
