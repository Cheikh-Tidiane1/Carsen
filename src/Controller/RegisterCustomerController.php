<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\RegisterCustomerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterCustomerController extends AbstractController
{
    #[Route('/inscriptionClient', name: 'register_customer')]
    public function index(Request $request,ManagerRegistry $doctrine,UserPasswordHasherInterface $passwordHasher): Response
    {
        $client = new Client();
        $form = $this->createForm(RegisterCustomerType::class,$client);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

         $client = $form->getData();
         $password = $passwordHasher->hashPassword($client,$client->getPassword());
         $client->setPassword($password);
         $roleClient [] ="ROLE_CUSTOMER";
         $client->setRoles($roleClient);

         $entityManager = $doctrine->getManager();
         $entityManager->persist($client);
         $entityManager->flush($client);

        }

        return $this->render('register_customer/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
