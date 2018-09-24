<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AvantController extends AbstractController
{
    /**
     * @Route("/avant", name="misEnAvant")
     */
    public function index()
    {
        return $this->render('avant/index.html.twig', [
            'controller_name' => 'AvantController',
        ]);
    }
}
