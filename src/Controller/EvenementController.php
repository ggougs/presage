<?php

namespace App\Controller;

use App\Entity\Avant;
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
     * @Route("/evenement", name="evenement")

     */
    public function afficherEvenements(EvenementRepository $repository){

        $evenementArray = $repository->findAll();
        return $this->render('evenement/listeEvenement.html.twig', [
            'controller_name' => 'ActualiteController',
            'evenement' => $evenementArray,
        ]);

    }

    /**
     * @Route("/admin/Evenements", name="evenementAdmin")

     */
    public function afficherEvenementsAdmin(EvenementRepository $repository){

        $evenementArray = $repository->findAll();
        return $this->render('evenement/listEvenementsAdmin.html.twig', [
            'controller_name' => 'ActualiteController',
            'evenement' => $evenementArray,
        ]);

    }
 
    /**
     * @Route("admin/evenement/ajout", name="ajoutEvenement")
     * @Route("/admin/evenement/edit/{id}", name="editevenement",requirements={"id"="\d+"})
     
     */

    public function addEvenement(Evenement $evenement=null,Request $request, ObjectManager $manager, FileUploader $fileUploader )
    {
        
        if(is_null($evenement)) 
            $evenement = new Evenement();
           
       

        $form = $this->createFormBuilder($evenement)
            ->add('titre', TextType::class)
            ->add('dateEvenement', TextType::class)
            ->add('contenu', TextAreaType::class, array ('attr' => array('class' => 'ckeditor',)))
            ->add('localisation', textType::class)
            ->add('image', FileType::class, array('label' => 'Image (png file)','data_class' => null))
            ->add('save', SubmitType::class, array('label' => "Inserer un Evenement "))
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())  {
                $file = $form['image']->getData();
                $fileName = $fileUploader->upload($file);
        
                $evenement->setImage($fileName);
              
                    $manager->persist( $evenement );
                    $manager->flush();
        
                return $this->redirectToRoute('evenementAdmin');
            }

        return $this->render('evenement/ajoutEvenements.html.twig', array(
            'form' => $form->createView(),
        ));
    }
/**
     * @Route("/admin/evenement/delete/{id}", name="deleteEvenement",requirements={"id"="\d+"})
     */

    public function deleteEvenement(Evenement $evenement, ObjectManager $manager){
        $manager -> remove ($evenement);
        $manager->flush();
        return $this->redirectToRoute('evenementAdmin');
}

/**
     * @Route("/admin/actualite/eventAvant/{id}", name="eventAvant",requirements={"id"="\d+"})
     */

    public function miseEnAvant(Evenement $evenement,ObjectManager $manager,Avant $avant=null ) {
    
        $id= $evenement -> getId();
        $titre = $evenement->getTitre();
        $contenu = $evenement->getContenu();
        $image = $evenement ->getImage();
        $date = $evenement ->getDateEvenement();
        $avant = new Avant();

        $avant->setIdMisEnAvant($id)
               ->setTitre($titre)
               ->setContenu($contenu)
               ->setImage($image)
               ->setDate($date);
        $manager -> persist ($avant);
       $manager->flush();
       return $this->redirectToRoute('listeactualiteadmin');
      
    }
}
