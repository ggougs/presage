<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActualiteRepository;

class ActualiteController extends AbstractController
{
    // /**
    //  * @Route("/actualite", name="actualite")
    //  */
    // public function index()
    // {
    //     return $this->render('accueil/index.html.twig', [
    //         'controller_name' => 'ActualiteController',
    //     ]);
    // }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function afficherActualité(ActualiteRepository $repository){

        $actualiteArray = $repository->findAll();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actualite' => $actualiteArray,
        ]);

    }

}
