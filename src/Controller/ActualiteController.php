<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Service\FileUploader;
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
     * @Route("/actualite", name="actualite")
     */
    public function index()
    {
        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }
    /**
     * @Route("admin/actualite/ajout", name="ajoutActualite")
     
     */

    public function addActualite(Actualite $actualite=null,Request $request, ObjectManager $manager, FileUploader $fileUploader )
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
        
                return $this->redirectToRoute('actualite');
            }

        return $this->render('actualite/ajoutActualites.html.twig', array(
            'form' => $form->createView(),
        ));
     


       

    }
}