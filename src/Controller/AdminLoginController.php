<?php

namespace App\Controller;

use App\Entity\Administrateur;
use App\Form\AdminType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminLoginController extends AbstractController
{
    #[Route('/admin/login', name: 'adminLogin')]
    public function index(Request $request,ManagerRegistry $doctrine,UserPasswordHasherInterface $passwordHasher): Response
    {

        $admin = new Administrateur();
        $form = $this->createForm(AdminType::class,$admin);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $admin = $form->getData();
            $password = $passwordHasher->hashPassword($admin,$admin->getPassword());
            $admin->setPassword($password);
            $roleAdmin [] ="ROLE_ADMIN";
            $admin->setRoles($roleAdmin);
            $numMatricule = 'MAT-877' ;
            $admin->setMatricule($numMatricule);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($admin);
            $entityManager->flush();
        }


        return $this->render('admin_login/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
