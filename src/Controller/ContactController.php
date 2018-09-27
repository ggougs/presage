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

public function contactForm (Contact $contact=null, Request $request, ObjectManager $manager,\Swift_Mailer $mailer)
    {
        
        if(is_null($contact)) 
            $contact = new Contact();
           
       

        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('sujet', TextType::Class)
            ->add('message', TextareaType::class)

            ->getForm();

            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid())  {

                $message = (new \Swift_Message())
                ->setSubject('Formulaire de contact')
                ->setFrom('testwebforce3mail@gmail.com')
                ->setTo('testwebforce3mail@gmail.com');
                
                $message->setBody(
                    $this->renderView(
                       
                        'emails/contact.html.twig',array('nom' => $contact->getNom(),'prenom'=>$contact->getPrenom(),'email'=>$contact->getEmail(),'message'=>$contact->getMessage())
                    ),
                    'text/html'
                );

 
                    $mailer->send($message);
                    $manager->persist( $contact );
                    $manager->flush();
        
                return $this->redirectToRoute('contact');
            }

        return $this->render('contact/formulaire.html.twig', array(
            'form' => $form->createView(),
           
        ));
    }
}