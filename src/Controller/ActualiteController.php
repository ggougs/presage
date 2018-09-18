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
     * @Route("/actualite", name="actualite")
     */
    public function afficherActualité(ActualiteRepository $repository){

        $actualiteArray = $repository->findAll();
        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actualite' => $actualiteArray,
        ]);

    }
     /**
     * @Route("/accueil", name="accueil")
     */
    public function acutaliteMiseEnAvant(ActualiteRepository $repository){
        $actuAvantArray = $repository->findOneById(1);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actuAvant' => $actuAvantArray,
        ]);
    }

}
