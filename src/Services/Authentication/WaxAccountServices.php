<?php

namespace App\Services\Authentication;

use App\Entity\User;
use App\Interfaces\Authentication\WaxAccountInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class WaxAccountServices implements WaxAccountInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private UserRepository $userRepository)
    {}

    public function checkUserAccount(Request $request): ?string
    {
        return $request->get('userAccount');
    }

    public function getUserAccount(?string $userAccount): ?UserInterface
    {
        return $this->entityManager->getRepository(User::class)
            ->findOneBy(['userAccount' => $userAccount]);
    }

    public function createNewAccount(?string $userAccount): void
    {
        $user = new User();
        $user->setUserAccount($userAccount);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function connectUserByWaxWallet(?string $userAccount): UserInterface
    {
        return $this->userRepository->loadUserByIdentifier($userAccount);
    }
}