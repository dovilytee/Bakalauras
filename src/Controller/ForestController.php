<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForestController extends AbstractController
{
    #[Route('/forest', name: 'app_forest')]
    public function index(): Response
    {
        return $this->render('forest/index.html.twig', [
            'controller_name' => 'ForestController',
        ]);
    }
}
