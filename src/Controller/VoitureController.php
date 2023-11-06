<?php

namespace App\Controller;

use App\Classe\Search;
use App\Form\SearchType;
use App\Repository\VoitureRepository;
use App\Entity\Voiture;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{



    #[Route('/nos-voitures', name: 'voitures')]
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {


        $voitures = $doctrine->getRepository(Voiture::class)->findAll();
        $search = new Search();
        $form = $this->createForm(SearchType::class,$search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $voitures = $doctrine->getRepository(Voiture::class)->findWithSearch($search);
        }

        return $this->render('voiture/index.html.twig', [
            'voitures'=>$voitures,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/voiture/{slug}', name: 'voiturePerso')]
    public function show(ManagerRegistry $doctrine,$slug): Response
    {

        $voiture =  $doctrine->getRepository(Voiture::class)->findOneBySlug($slug);
        if(!$voiture){
             return $this->redirectToRoute('voitures');
        }

        return $this->render('voiture/show.html.twig',[
            'voiture'=>$voiture

        ]);
    }
}
