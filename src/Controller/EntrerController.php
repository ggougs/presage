<?php

namespace App\Controller;

use App\Repository\AvantRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrerController extends AbstractController
{
       /**
     * @Route("/accueil", name="accueil")
     */
    public function acutaliteMiseEnAvantAccueil(AvantRepository $repository, EvenementRepository $repo ){
       
      
        // $evenementAvantArray = $evenementRepository->findOneById($idEvent);
        // return $this->render('evenement/index.html.twig', [
        //     'controller_name' => 'ActualiteController',
        //     'evenementAvant' => $evenementAvantArray,
        //     ]);
   
        $actuAvantArray = $repository->findBy(array(), array('id' => 'desc'));
            
    
        return $this->render('entrer/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actuAvant' => $actuAvantArray,
            dump($actuAvantArray),
            
        ]);
       
    
   
}

}
