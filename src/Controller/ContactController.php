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
<<<<<<< HEAD
}
=======


/**
* @Route("/formulaire", name="form")
*/

public function contactForm (Contact $contact=null, Request $request, ObjectManager $manager,\Swift_Mailer $mailer)
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
                $message = (new \Swift_Message())
                ->setFrom('garabedian.g@gmail.com')
                ->setTo('garabedian.g@gmail.com')
                ->setBody(
                    $this->renderView(
                       
                        'emails/contact.html.twig'
                    ),
                    'text/html'
                );

 
           $mailer->send($message);
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
>>>>>>> 00497d4c7f5a995da60f8d06f481672ac3a48d67
