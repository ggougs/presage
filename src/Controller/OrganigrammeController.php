<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrganigrammeController extends AbstractController
{
    /**
     * @Route("/organigramme", name="organigramme")
     */
    public function index()
    {
        return $this->render('organigramme/index.html.twig', [
            'controller_name' => 'OrganigrammeController',
        ]);
    }
}
