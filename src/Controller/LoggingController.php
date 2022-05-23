<?php

namespace App\Controller;

use App\Entity\Logging;
use App\Form\LoggingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoggingController extends AbstractController
{
    #[Route('/logging', name: 'logging')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $logging = new Logging();
        $logging->setCity('');
        $logging->setAddress('');
        $logging->setPrice('');
        $logging->setAction('');
        $logging->setStatus('');
        $form = $this->createForm(LoggingType::class, $logging, [
            'action' => $this->generateUrl('logging'),
            'method'=> 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em->persist($logging);


        }
        $em->flush();
        return $this->render('logging/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
