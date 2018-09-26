<?php

namespace App\Controller;

use App\Entity\Avant;
use App\Entity\Actualite;
use App\Service\FileUploader;
use App\Repository\AvantRepository;
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
        return $this->render('actualite/listeActualitesAdmin.html.twig', [
            'controller_name' => 'ActualiteController',
            'actualite' => $actualiteArray,
        ]);
    }

     /**
     * @Route("/", name="entrer")
     */
    public function acutaliteMiseEnAvant(AvantRepository $repository, EvenementRepository $repo ){
       
      
            // $evenementAvantArray = $evenementRepository->findOneById($idEvent);
            // return $this->render('evenement/index.html.twig', [
            //     'controller_name' => 'ActualiteController',
            //     'evenementAvant' => $evenementAvantArray,
            //     ]);
       
            $actuAvantArray = $repository->findBy(array(), array('id' => 'desc'));
                
        
            return $this->render('accueil/index.html.twig', [
                'controller_name' => 'ActualiteController',
                'actuAvant' => $actuAvantArray,
                dump($actuAvantArray),
                
            ]);
           
        
       
    }
    /**
     * @Route("admin/actualite/ajout", name="ajoutActualite")
     * @Route("/admin/actualite/edit/{id}", name="editactu",requirements={"id"="\d+"})
     
     */

    public function ajoutActualite(Actualite $actualite=null,Request $request, ObjectManager $manager, FileUploader $fileUploader )
    {
        
        if(is_null($actualite)) {
            $actualite = new Actualite();

            $form = $this->createFormBuilder($actualite)
            ->add('titre', TextType::class)
            ->add('dateActualite', TextType::class)
            ->add('contenu', TextAreaType::class, array ('attr' => array('class' => 'ckeditor',)))
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
        else {
            $form = $this->createFormBuilder($actualite)
            ->add('titre', TextType::class)
            ->add('contenu', TextAreaType::class, array ('attr' => array('class' => 'ckeditor',)))
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
           
    }
    
/**
     * @Route("/admin/actualite/delete/{id}", name="deleteActu",requirements={"id"="\d+"})
     */

public function deleteActualite(Actualite $actualite, ObjectManager $manager){
        $manager -> remove ($actualite);
        $manager->flush();
        return $this->redirectToRoute('listeactualiteadmin');
}
/**
     * @Route("/admin/actualite/avant/{id}", name="avant",requirements={"id"="\d+"})
     */

public function miseEnAvant(Actualite $actualite,ObjectManager $manager,Avant $avant=null ) {
    
         $id= $actualite -> getId();
         $titre = $actualite->getTitre();
         $contenu = $actualite->getContenu();
         $image = $actualite ->getImage();
         $date = $actualite ->getDateActualite();
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