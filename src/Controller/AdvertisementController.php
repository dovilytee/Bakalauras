<?php

namespace App\Controller;

use App\Entity\Forest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertisementController extends AbstractController
{
    #[Route('advertisement/advertisement', name: 'advertisement')]
    public function advertisement()
    {
        $em = $this->getDoctrine()->getManager();
        $forests = $em->getRepository(Forest::class)->findAll();

        return $this->render('advertisement/advertisement.html.twig', [
            'forests'=>$forests
        ]);
    }
    #[Route('advertisement/my_advertisement', name: 'my_advertisement')]
    public function myadvertisement()
    {
        $em = $this->getDoctrine()->getManager();
        $forests = $em->getRepository(Forest::class)->findAll();

        return $this->render('advertisement/my_advertisement.html.twig', [
            'forests'=>$forests
        ]);
    }
}
