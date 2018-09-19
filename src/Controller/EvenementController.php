<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Service\FileUploader;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
 {
 
    /**
     * @Route("admin/evenement/ajout", name="ajoutEvenement")
     
     */

    public function addEvenement(Evenement $evenement=null,Request $request, ObjectManager $manager, FileUploader $fileUploader )
    {
        
        if(is_null($evenement)) 
            $evenement = new Evenement();
           
       

        $form = $this->createFormBuilder($evenement)
            ->add('titre', TextType::class)
            ->add('contenu', TextareaType::class)
            ->add('localisation', textType::class)
            ->add('image', FileType::class, array('label' => 'Image (png file)','data_class' => null))
            ->add('save', SubmitType::class, array('label' => "Inserer l'actualité "))
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())  {
                $file = $form['image']->getData();
                $fileName = $fileUploader->upload($file);
        
                $evenement->setImage($fileName);
              
                    $manager->persist( $evenement );
                    $manager->flush();
        
                return $this->redirectToRoute('evenement');
            }

        return $this->render('evenement/ajoutEvenements.html.twig', array(
            'form' => $form->createView(),
        ));
     


       

    }
}
