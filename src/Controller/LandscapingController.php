<?php

namespace App\Controller;

use App\Entity\Landscaping;
use App\Form\LandscapingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandscapingController extends AbstractController
{
    #[Route('/landscaping', name: 'landscaping')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $landscaping = new Landscaping();
        $landscaping->setCity('');
        $landscaping->setAddress('');
        $landscaping->setPrice('');
        $landscaping->setAction('');
        $landscaping->setStatus('');
        $form = $this->createForm(LandscapingType::class, $landscaping, [
            'action' => $this->generateUrl('landscaping'),
            'method'=> 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em->persist($landscaping);


        }
        $em->flush();
        return $this->render('landscaping/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
