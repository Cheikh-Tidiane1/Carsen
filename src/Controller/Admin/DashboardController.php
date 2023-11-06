<?php

namespace App\Controller\Admin;

use App\Entity\Administrateur;
use App\Entity\Client;
use App\Entity\Demande;
use App\Entity\DemandeLocation;
use App\Entity\Demandes;
use App\Entity\DemandeVente;
use App\Entity\Marque;
use App\Entity\Proprietaire;
use App\Entity\Reservation;
use App\Entity\TypeVoiture;
use App\Entity\User;
use App\Entity\Voiture;
use App\Entity\VoitureLoc;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(VoitureCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Carsen V1');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');

        yield MenuItem::section('Voitures','fa-solid fa-car');
        yield MenuItem::subMenu('Vente','fa-solid fa-shop')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-plus', Voiture::class)
        ]);
        yield MenuItem::subMenu('Location','fa-solid fa-cart-shopping')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-plus', VoitureLoc::class)
        ]);
        yield MenuItem::subMenu('Types & Marques','fas fa-list')->setSubItems([
             MenuItem::linkToCrud('Ajouter un type', 'fa-solid fa-plus', TypeVoiture::class),
             MenuItem::linkToCrud('Ajouter une marque', 'fa-solid fa-plus', Marque::class)
        ]);

        yield MenuItem::section('Utilisateurs','fa-solid fa-users');
        yield MenuItem::subMenu('Propriétaire','fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-list', Proprietaire::class)
        ]);
        yield MenuItem::subMenu('Client','fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-list', Client::class)
        ]);


        yield MenuItem::section('Demandes','fa-solid fa-code-pull-request');
        yield MenuItem::subMenu('Vente','fa-solid fa-arrow-right')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-list', DemandeVente::class)
        ]);
        yield MenuItem::subMenu('Location','fa-solid fa-arrow-up-right-from-square')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-list', DemandeLocation::class)
        ]);


        yield MenuItem::section('Reservations','fa-solid fa-code-pull-request');
        yield MenuItem::linkToCrud('Liste', 'fas fa-list', Reservation::class);
        #yield MenuItem::linkToCrud('Demande', 'fa-solid fa-code-pull-request', DemandeVente::class);

        #yield MenuItem::linkToCrud('Admin', 'fa-solid fa-users', Administrateur::class);
        #yield MenuItem::linkToCrud('Demande', 'fa-solid fa-code-pull-request', Demande::class);


    }
}

