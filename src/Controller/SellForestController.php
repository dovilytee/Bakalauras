<?php

namespace App\Controller;

use App\Entity\Forest;
use App\Form\SellForestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellForestController extends AbstractController
{
    #[Route('/sell/forest', name: 'sell_forest')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $forest = new Forest();
        $forest->setCity('');
        $forest->setAdress('');
        $forest->setSize('');
        $forest->setWood('');
        $forest->setCare('');
        $forest->setAction('');
        $forest->setStatus('');
        $form = $this->createForm(SellForestType::class, $forest, [
            'action' => $this->generateUrl('sell_forest'),
            'method'=> 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em->persist($forest);


        }
        $em->flush();
        return $this->render('sell_forest/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
