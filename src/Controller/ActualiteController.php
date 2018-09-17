<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    /**
     * @Route("/actualite", name="actualite")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }
}
