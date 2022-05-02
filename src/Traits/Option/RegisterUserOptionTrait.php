<?php

namespace App\Traits\Option;

use App\Entity\Option;
use Symfony\Component\Security\Core\User\UserInterface;

trait RegisterUserOptionTrait
{
    /**
     * @param array $data
     * @param UserInterface $user
     *
     * @return void
     */
    public function registerOptions(array $data, UserInterface $user): void
    {
        $option = $user->getUserOption();

        if (null === $option) {
            $option = new Option();
            $user->setUserOption($option);
        }

        $option
            ->setMusicActivated(isset($data['Activate_Music']))
            ->setLanguage($data['Language'])
            ->setAButton($data['A_Button'])
            ->setBButton($data['B_Button'])
            ->setCButton($data['C_Button'])
            ->setDButton($data['D_Button'])
            ->setTheme($data['Theme'])
        ;

        $this->entityManager->persist($option);
        $this->entityManager->flush();
    }
}