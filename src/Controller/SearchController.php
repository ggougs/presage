<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Actualite;
use App\Entity\Evenement;

class SearchController extends AbstractController
{
    
    /**
     * @Route("/search", name="search")
     * 
     */
    public function searchActua(Request $request) {
        $results = array();
        if ($request->getMethod() == "GET") {
            $search = $request->query->get('search');
       
            $datas = explode(" ", $search);
       
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQueryBuilder();
            $query
                ->select('a.titre, a.contenu','a.image','a.dateActualite')
                ->from(Actualite::class, 'a');
            $i = 0;
          
            foreach ($datas as $data) {
                $query
                    ->andWhere('a.titre LIKE :data'.$i.' OR a.contenu LIKE :data'.$i)
                    ->setParameter('data'.$i, '%'.$data.'%');
               $i++;
            }
            $results = $query->getQuery()->getResult();
           
            dump($results);
        }
        return $this->render('search/search.html.twig', array(
            'results' => $results
        ));
    }

} 
