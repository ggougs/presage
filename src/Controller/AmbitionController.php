<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AmbitionController extends AbstractController
{
    /**
     * @Route("/ambition", name="ambition")
     */
    public function index()
    {
        return $this->render('ambition/index.html.twig', [
            'controller_name' => 'AmbitionController',
        ]);
    }
}
