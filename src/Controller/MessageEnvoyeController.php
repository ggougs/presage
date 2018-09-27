<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MessageEnvoyeController extends AbstractController
{
    /**
     * @Route("/message/envoye", name="message_envoye")
     */
    public function index()
    {
        return $this->render('message_envoye/index.html.twig', [
            'controller_name' => 'MessageEnvoyeController',
        ]);
    }
}
