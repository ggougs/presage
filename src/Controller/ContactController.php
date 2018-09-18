<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Contact;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }


/**
* @Route("/formulaire", name="form")
*/

public function contactForm (Contact $contact=null, Request $request, ObjectManager $manager)
    {
        
        if(is_null($contact)) 
            $contact = new Contact();
           
       

        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('sujet', TextType::class)
            ->add('message', TextType::class)
            ->add('save', SubmitType::class, array('label' => "Valider "))
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())  {
                    $manager->persist( $contact );
                    $manager->flush();
        
                return $this->redirectToRoute('form');
            }

        return $this->render('contact/formulaire.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
?>