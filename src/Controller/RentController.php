<?php

namespace App\Controller;

use App\Classe\CartRent;
use App\Classe\SearchRent;
use App\Entity\VoitureLoc;
use App\Form\SearchRentType;
use App\Repository\VoitureLocRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    #[Route('/location', name: 'rent')]
    public function index(Request $request ,ManagerRegistry $doctrine): Response
    {
       // $voitureLoc = $doctrine->getRepository(VoitureLoc::class)->findAll();
        $searchRent = new SearchRent();
        $form = $this->createForm(SearchRentType::class,$searchRent);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {

            $dateDebut = $form->get('dateDebut')->getData();
            $dateFin = $form->get('dateFin')->getData();
            $nombreDeJour =  $dateFin->diff($dateDebut)->format("%a");
            //dd($diif);

            $voitureLoc = $doctrine->getRepository(VoitureLoc::class)->findByWithSearchRent($searchRent);
            return $this->render('rent/list.html.twig',[
                'voitureLoc'=> $voitureLoc,
                'form'=> $form->createView(),
                'dateDebut'=>$dateDebut->format('d-m-Y'),
                'dateFin'=>$dateFin->format('d-m-Y'),
                'nombreDeJour'=>$nombreDeJour
            ]);
           // dd($voitureLoc);
        }

        return $this->render('rent/index.html.twig',[
            'form'=> $form->createView()
            ]);
    }

    #[Route('/location/{slug}/{dateDebut}/{dateFin}/{nombreDeJour}', name: 'rentCarPerso')]
    public function list(ManagerRegistry $doctrine,$slug,$dateDebut,$dateFin,$nombreDeJour): Response
    {
        $voitureLocPerso = $doctrine->getRepository(VoitureLoc::class)->findOneBySlug($slug);
       // $idVoiture = $voitureLocPerso->get
        if(!$voitureLocPerso){
            return $this->redirectToRoute('rent');
        }
        return $this->render('rent/show.html.twig',[
            'voitureLocPerso'=>$voitureLocPerso,
            'dateDebut'=> $dateDebut,
            'dateFin'=> $dateFin,
            'nombreDeJour'=> $nombreDeJour

        ]);
    }
}
