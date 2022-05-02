<?php

namespace App\Controller\Game;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stages', name: 'stages_')]
class StageSelectorController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(Request $request): Response
    {

    }
}