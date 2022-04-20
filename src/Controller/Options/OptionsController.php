<?php

namespace App\Controller\Options;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/options', name: 'options')]
class OptionsController extends AbstractController
{
    #[Route('', name: '')]
    public function options(): Response
    {
        return $this->render('options.html.twig');
    }

}