<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Form\RegisterOwnerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterOwnerController extends AbstractController
{
    #[Route('/inscriptionVendeur', name: 'register_owner')]
    public function index(Request $request,ManagerRegistry $doctrine,UserPasswordHasherInterface $passwordHasher): Response
    {
        $proprietaire = new Proprietaire();
        $form = $this->createForm(RegisterOwnerType::class,$proprietaire);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $proprietaire = $form->getData();
            $password = $passwordHasher->hashPassword($proprietaire,$proprietaire->getPassword());
            $proprietaire->setPassword($password);
            $proprietaire->setRoles(["ROLE_OWNER"]);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($proprietaire);
            $entityManager->flush($proprietaire);
        }

        return $this->render('register_owner/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
