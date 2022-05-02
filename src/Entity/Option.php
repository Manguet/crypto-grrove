<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $musicActivated;

    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    private $language;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $aButton;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $bButton;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cButton;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $dButton;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $theme;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function getActivateMusic(): ?bool
    {
        return $this->musicActivated;
    }

    /**
     * @param bool|null $musicActivated
     *
     * @return Option
     */
    public function setMusicActivated(?bool $musicActivated): self
    {
        $this->musicActivated = $musicActivated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     *
     * @return Option
     */
    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAButton(): ?int
    {
        return $this->aButton;
    }

    /**
     * @param int|null $aButton
     *
     * @return Option
     */
    public function setAButton(?int $aButton): self
    {
        $this->aButton = $aButton;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBButton(): ?int
    {
        return $this->bButton;
    }

    /**
     * @param int|null $bButton
     *
     * @return Option
     */
    public function setBButton(?int $bButton): self
    {
        $this->bButton = $bButton;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCButton(): ?int
    {
        return $this->cButton;
    }

    /**
     * @param int|null $cButton
     *
     * @return Option
     */
    public function setCButton(?int $cButton): self
    {
        $this->cButton = $cButton;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDButton(): ?int
    {
        return $this->dButton;
    }

    /**
     * @param int|null $dButton
     *
     * @return Option
     */
    public function setDButton(?int $dButton): self
    {
        $this->dButton = $dButton;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTheme(): ?string
    {
        return $this->theme;
    }

    /**
     * @param string|null $theme
     *
     * @return Option
     */
    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
