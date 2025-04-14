<?php

namespace App\Entity;

use App\Repository\ImageSliderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageSliderRepository::class)]
class ImageSlider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Url = null;

    #[ORM\Column]
    private ?int $Position = null;

    #[ORM\Column(length: 50)]
    private ?string $Slider = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(string $Url): static
    {
        $this->Url = $Url;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->Position;
    }

    public function setPosition(int $Position): static
    {
        $this->Position = $Position;

        return $this;
    }

    public function getSlider(): ?string
    {
        return $this->Slider;
    }

    public function setSlider(string $Slider): static
    {
        $this->Slider = $Slider;

        return $this;
    }
}
