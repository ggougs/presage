<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Service\FileUploader;
use App\Repository\ActualiteRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualiteController extends AbstractController
{
   

     /**
     * @Route("/actualite", name="listeactualite")
     * 
     */
    public function afficherActualité(ActualiteRepository $repository){

        $actualiteArray = $repository->findAll();
        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actualite' => $actualiteArray,
        ]);
    }
     /**
     * @Route("/admin/actualiteadmin", name="listeactualiteadmin")
     */
    public function afficherActualitéAdmin(ActualiteRepository $repository){

        $actualiteArray = $repository->findAll();
        return $this->render('actualite/listeActualites.html.twig', [
            'controller_name' => 'ActualiteController',
            'actualite' => $actualiteArray,
        ]);
    }

     /**
     * @Route("/accueil", name="accueil")
     */
    public function acutaliteMiseEnAvant(ActualiteRepository $repository, EvenementRepository $evenementRepository){
        $idActu=1;
        $idEvent=null;
        if($idActu == null){
            $evenementAvantArray = $evenementRepository->findOneById($idEvent);
            return $this->render('evenement/index.html.twig', [
                'controller_name' => 'ActualiteController',
                'evenementAvant' => $evenementAvantArray,
                ]);
        }else{
            $actuAvantArray = $repository->findOneById($idActu);
            return $this->render('accueil/index.html.twig', [
                'controller_name' => 'ActualiteController',
                'actuAvant' => $actuAvantArray,
            ]);
        } 
       
    }
    /**
     * @Route("admin/actualite/ajout", name="ajoutActualite")
     
     */

    public function ajoutActualite(Actualite $actualite=null,Request $request, ObjectManager $manager, FileUploader $fileUploader )
    {
        
        if(is_null($actualite)) 
            $actualite = new Actualite();
           
       

        $form = $this->createFormBuilder($actualite)
            ->add('titre', TextType::class)
            ->add('contenu', TextareaType::class)
            ->add('image', FileType::class, array('label' => 'Image (png file)','data_class' => null))
            ->add('save', SubmitType::class, array('label' => "Inserer l'actualité "))
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())  {
                $file = $form['image']->getData();
                $fileName = $fileUploader->upload($file);
        
                $actualite->setImage($fileName);
              
                    $manager->persist( $actualite );
                    $manager->flush();
        
                return $this->redirectToRoute('admin_interface');
            }

        return $this->render('actualite/ajoutActualites.html.twig', array(
            'form' => $form->createView(),
        ));
    }

/**
     * @Route("/admin/actualite/delete/{id}", name="deleteActu",requirements={"id"="\d+"})
     */

public function deleteActualite(Actualite $actualite, ObjectManager $manager){
        $manager -> remove ($actualite);
        $manager->flush();
        return $this->redirectToRoute('admin_interface');
}


}
