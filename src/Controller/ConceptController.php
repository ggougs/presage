<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConceptController extends AbstractController
{
    /**
     * @Route("/concept", name="concept")
     */
    public function index()
    {
        return $this->render('concept/index.html.twig', [
            'controller_name' => 'ConceptController',
        ]);
    }
}
