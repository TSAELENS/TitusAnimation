<?php

namespace App\Entity;

use App\Repository\ImageGalleryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageGalleryRepository::class)]
#[Vich\Uploadable]
class ImageGallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: "image_gallery", fileNameProperty: "image")]
    private ?File $imageFile = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    // #[ORM\Column(type: 'integer', nullable: false)]
    // private ?int $page = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile !== null) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    // public function getPage(): ?int
    // {
    //     return $this->page;
    // }

    // public function setPage(int $page): self
    // {
    //     $this->page = $page;
    //     return $this;
    // }

    // // Optionnel : mapping entre l’entier et le label
    // public const PAGES = [
    //     1 => 'Sur scène',
    //     2 => 'Sculpture fixe',
    //     3 => 'Sculpture mobile',
    //     4 => 'Décoration',
    //     5 => 'Conte (médiéval)',
    // ];

    // public function getPageLabel(): string
    // {
    //     return self::PAGES[$this->page] ?? 'Inconnu';
    // }

    #[ORM\Column(type: 'boolean')]
    private ?bool $accueil = false;

    public function isAccueil(): ?bool
    {
        return $this->accueil;
    }

    public function setAccueil(bool $accueil): static
    {
        $this->accueil = $accueil;
        return $this;
    }
}