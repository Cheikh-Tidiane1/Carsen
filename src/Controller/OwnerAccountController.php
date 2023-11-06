<?php

namespace App\Controller;


use App\Entity\DemandeLocation;
use App\Entity\Demandes;
use App\Entity\DemandeVente;
use App\Entity\Proprietaire;
use App\Form\DemandeLocationType;
use App\Form\DemandeVenteType;
use App\Repository\DemandeLocationRepository;
use App\Repository\DemandesRepository;
use App\Repository\DemandeVenteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class OwnerAccountController extends AbstractController
{
    #[Route('/compteOwner', name: 'ownerAccount')]
    public function index(Request $request,ManagerRegistry $doctrine,SluggerInterface $slugger,DemandesRepository $demandeRepo): Response
    {

        $demandeVente = new DemandeVente();
        $form = $this->createForm(DemandeVenteType::class,$demandeVente);
        $demandeBi = $doctrine->getRepository(Demandes::class)->findByProprietaire($this->getUser());
        //dd($demandeBi);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $photo = $form->get('photo')->getData();
            if ($photo) {

                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();
                try {
                    $photo->move(
                        $this->getParameter('voiturephoto_directory'),
                        $newFilename
                    );
                } catch (FileException  $e) {

                }
                $demandeVente->setPhoto($newFilename);

            }

            $demandeVente = $form->getData();
            $demandeVente->setDate(date('d-m-y'));
            $demandeVente->setProprietaire($this->getUser()) ;

            $entityManager = $doctrine->getManager();
            $entityManager->persist($demandeVente);
            $entityManager->flush();

        }
        // dd($demandeRepo->findAll());


        return $this->render('owner_account/index.html.twig',[
            'form'=>$form->createView(),
            'demandeRepo'=>$demandeRepo->findAll(),
            'demandeBi'=>$demandeBi
        ]);
    }



       #[Route('/compteOwner/loc', name: 'ownerAccountLoc')]
       public function add(Request $request,ManagerRegistry $doctrine,SluggerInterface $slugger): Response
       {
           $demandeLocation = new DemandeLocation();
           $form = $this->createForm(DemandeLocationType::class,$demandeLocation);
           $form->handleRequest($request);

           if($form->isSubmitted() && $form->isValid())
           {
               $photoLoc = $form->get('photo')->getData();
               if ($photoLoc) {

                   $originalFilename = pathinfo($photoLoc->getClientOriginalName(), PATHINFO_FILENAME);
                   $safeFilename = $slugger->slug($originalFilename);
                   $newFilename = $safeFilename.'-'.uniqid().'.'.$photoLoc->guessExtension();
                   try {
                       $photoLoc->move(
                           $this->getParameter('voiturephoto_directory'),
                           $newFilename
                       );
                   } catch (FileException  $e) {

                   }
                   $demandeLocation->setPhoto($newFilename);

               }

               $demandeLocation = $form->getData();
               $demandeLocation->setDate(date('d-m-y'));
               $demandeLocation->setProprietaire($this->getUser()) ;
             //  dd($demandeLocation);
               $entityManager = $doctrine->getManager();
               $entityManager->persist($demandeLocation);
               $entityManager->flush();

           }


          return $this->render('owner_account/add.html.twig',[
               'form'=>$form->createView()
           ]);

       }


}
