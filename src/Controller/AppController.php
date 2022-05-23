<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
    #[Route('/profile', name: 'profile')]
    public function profile()
    {
        return $this->render('profile.html.twig');
    }
    #[Route('notifications/chat', name: 'chat')]
    public function chat()
    {
        return $this->render('notifications/chat.html.twig');
    }
}
