<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request) {
        if ($request->getMethod() == "POST") {
            $search = $request->request->get('search');
       
            $datas = explode(" ", $search);
       
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQueryBuilder();
            $query
                ->select('titre', 'contenu')
                ->from('actualite', 'a');
            $i = 0;
            foreach ($datas as $data) {
                $query
                    ->andWhere('a.titre LIKE :data'.$i.' OR a.contenu LIKE :data'.$i)
                    ->setParameter('data'.$i, '%'.$data.'%');
               $i++;
            }
            $results = $query->getQuery()->getResult(); 
        }
        return $this->render('search/search.html.twig', array(
            'results' => $results
        ));
    }
    


} 
