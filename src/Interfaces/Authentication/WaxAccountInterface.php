<?php

namespace App\Interfaces\Authentication;

use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

interface WaxAccountInterface
{
    public function checkUserAccount(Request $request): ?string;

    public function getUserAccount(?string $userAccount): ?UserInterface;

    public function createNewAccount(?string $userAccount): void;

    /**
     * @throws NonUniqueResultException
     */
    public function connectUserByWaxWallet(?string $userAccount): UserInterface;
}