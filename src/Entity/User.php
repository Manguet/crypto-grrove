<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $pseudo;

    #[ORM\Column(type: 'string', length: 80)]
    private string $userAccount;

    /** @ORM\OneToMany(targetEntity="Entity\Stock", mappedBy="product") */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Token::class)]
    private ?PersistentCollection $token;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $avatarName;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    #[Pure] public function getPseudo(): ?string
    {
        return $this->pseudo;

    }

    /**
     * @return string|null
     */
    public function getPseudoFull(): ?string
    {
        return $this->pseudo
            ? $this->pseudo . ' <small>(' . $this->getUserAccount() . ')</small>'
            : $this->getUserAccount()
            ;
    }

    /**
     * @param string|null $firstName
     *
     * @return User
     */
    public function setPseudo(?string $firstName): self
    {
        $this->pseudo = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAccount(): string
    {
        return $this->userAccount;
    }

    /**
     * @param string $userAccount
     *
     * @return User
     */
    public function setUserAccount(string $userAccount): self
    {
        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles   = [];
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @return void
     */
    public function eraseCredentials(): void
    {
    }

    #[Pure] public function getUserIdentifier(): string
    {
        return $this->getUserAccount();
    }

    /**
     * @return PersistentCollection
     */
    public function getToken(): PersistentCollection
    {
        return $this->token;
    }

    /**
     * @param Token $token
     *
     * @return User
     */
    public function addToken(Token $token): self
    {
        if (!$this->token->contains($token)) {
            $token->setUser($this);
            $this->token[] = $token;
        }

        return $this;
    }

    public function getAvatarName()
    {
        return $this->avatarName;
    }

    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }
}
