<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StageRepository::class)]
class Stage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 80)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $imageFile;

    #[ORM\Column(type: 'integer')]
    private $duration;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $highScore;

    #[ORM\Column(type: 'string', length: 100)]
    private $music;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $playedQuantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(string $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getHighScore(): ?int
    {
        return $this->highScore;
    }

    public function setHighScore(?int $highScore): self
    {
        $this->highScore = $highScore;

        return $this;
    }

    public function getMusic(): ?string
    {
        return $this->music;
    }

    public function setMusic(string $music): self
    {
        $this->music = $music;

        return $this;
    }

    public function getPlayedQuantity(): ?int
    {
        return $this->playedQuantity;
    }

    public function setPlayedQuantity(?int $playedQuantity): self
    {
        $this->playedQuantity = $playedQuantity;

        return $this;
    }
}
