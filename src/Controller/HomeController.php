<?php

namespace App\Controller;

use App\Entity\Voiture;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $voitures = $doctrine->getRepository(Voiture::class)->findByIsBest(1);
        return $this->render('home/index.html.twig',[
            'voitures'=>$voitures
        ]);
    }
}
