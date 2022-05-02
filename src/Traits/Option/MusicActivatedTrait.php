<?php

namespace App\Traits\Option;

use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\UserInterface;

trait MusicActivatedTrait
{
    #[Pure] public function isMusicActivated(?UserInterface $user): bool
    {
        if (null === $user || null === $user->getUserOption()) {
            return true;
        }

        return $user->getUserOption()->getActivateMusic();
    }
}