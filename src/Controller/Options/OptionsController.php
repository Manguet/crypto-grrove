<?php

namespace App\Controller\Options;

use App\Form\OptionsForm;
use App\Traits\Option\MusicActivatedTrait;
use App\Traits\Option\RegisterUserOptionTrait;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/options', name: 'options')]
class OptionsController extends AbstractController
{
    use RegisterUserOptionTrait;
    use MusicActivatedTrait;

    public function __construct(private ?KernelInterface $kernel, private ?EntityManagerInterface $entityManager) {}

    #[Route('', name: '')]
    public function options(Request$request): Response
    {
        $options  = require $this->kernel->getProjectDir() . '/documents/config/options.php';

        if ($this->getUser() && $this->getUser()->getUserOption()) {
            $optionRegistred = $this->getUser()->getUserOption();
        }

        $keyPress = require $this->kernel->getProjectDir() . '/documents/config/keypress.php';

        if (empty($options)) {
            throw new LogicException('There is no options', 400);
        }

        $form = $this->createForm(OptionsForm::class, null, [
            'options'          => $options,
            'keyPress'         => $keyPress,
            'optionRegistered' => $optionRegistred ?? null
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->registerOptions($form->getData(), $this->getUser());

            $this->addFlash(
                'notice',
                'Options updated with success'
            );

            return $this->redirectToRoute('index_homepage');
        }

        return $this->render('options.html.twig', [
            'form'           => $form->createView(),
            'options'        => $options,
            'musicActivated' => $this->isMusicActivated($this->getUser())
        ]);
    }

}