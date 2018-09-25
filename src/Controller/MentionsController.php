<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MentionsController extends AbstractController
{
    /**
     * @Route("/mentionslegales", name="mentions")
     */
    public function index()
    {
        return $this->render('mentions/mentions.html.twig', [
            'controller_name' => 'MentionsController',
        ]);
    }
}
