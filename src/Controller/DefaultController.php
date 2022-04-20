<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'index')]
class DefaultController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'isNotPlayable' => true,
        ]);
    }

    #[Route('homepage', name: '_homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage.html.twig');
    }
}