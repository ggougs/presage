<?php

namespace App\Controller;

use App\Entity\AdminUser;
use App\Repository\AdminUserRepository;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user/adminuser", name="admin_interface")
     */
    public function index()
    {
        return $this->render('admin_user/index.html.twig', [
            'controller_name' => 'AdminUserController',
        ]);
    }

    /**
     * @Route("/admin/user/affiche", name="afficheAdmin")

     */
    public function afficheradmin(AdminUserRepository $repository){

        $adminArray = $repository->findAll();
        return $this->render('admin_user/listAdmin.html.twig', [
            'controller_name' => 'AdminUserController',
            'admins' => $adminArray,
        ]);

    }

    

    /**
     * @Route("admin/user/ajout", name="admin_user")
     */

    public function addAdminUser(AdminUser $adminUser=null,Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        if(is_null($adminUser)) {
        
            $adminUser = new AdminUser();

        $form = $this->createFormBuilder($adminUser)
        
            ->add('nom', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'le mot de passe ne correspond pas',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'confirmer Password'),
            ))
            ->add('save', SubmitType::class, array('label' => "creer un compte admin" ))
            
            ->getForm();
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid())  {
                
                $plainPassword= $adminUser->getPassword(); 
                $encoded = $encoder->encodePassword($adminUser, $plainPassword);
                $adminUser->setPassword($encoded);
                $manager->persist( $adminUser );
                $manager->flush();

         
                 return $this->redirectToRoute('admin_interface');
             }
 
   
             return $this->render('admin_user/ajoutAdmin.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }       
/**
     * @Route("/admin/user/delete/{id}", name="deleteAdmin",requirements={"id"="\d+"})
     */

    public function deleteadmin(AdminUser $adminUser, ObjectManager $manager){
        $manager -> remove ($adminUser);
        $manager->flush();
        return $this->redirectToRoute('afficheAdmin');
    }
}