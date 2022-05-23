<?php

namespace App\Controller;

use App\Entity\Wood;
use App\Form\SellWoodType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellWoodController extends AbstractController
{
    #[Route('/sell/wood', name: 'sell_wood')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $wood = new Wood();
        $wood->setCity('');
        $wood->setAddress('');
        $wood->setCount('');
        $wood->setWoodtype('');
        $wood->setAction('');
        $wood->setStatus('');
        $form = $this->createForm(SellWoodType::class, $wood, [
            'action' => $this->generateUrl('sell_wood'),
            'method'=> 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em->persist($wood);


        }
        $em->flush();
        return $this->render('sell_wood/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
