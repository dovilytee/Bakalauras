<?php

namespace App\Controller;

use App\Entity\Care;
use App\Form\CareType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CareController extends AbstractController
{
    #[Route('/care', name: 'care')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $care = new Care();
        $care->setCity('');
        $care->setAddress('');
        $care->setPrice('');
        $care->setAction('');
        $care->setStatus('');
        $form = $this->createForm(CareType::class, $care, [
            'action' => $this->generateUrl('care'),
            'method'=> 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em->persist($care);


        }
        $em->flush();
        return $this->render('care/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
