<?php

namespace App\Controller;

use App\Traits\Option\MusicActivatedTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'index')]
class DefaultController extends AbstractController
{
    use MusicActivatedTrait;

    #[Route('', name: '')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'isNotPlayable'  => true,
            'musicActivated' => $this->isMusicActivated($this->getUser())
        ]);
    }

    #[Route('homepage', name: '_homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage.html.twig', [
            'musicActivated' => $this->isMusicActivated($this->getUser())
        ]);
    }
}