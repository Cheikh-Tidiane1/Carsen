<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Form\CommandeType;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'commande')]
    public function index(Cart $cart,VoitureRepository  $voiture,Request $request): Response
    {
        $adresse = $this->getUser()->getAdresse();
        $form = $this->createForm(CommandeType::class);

        return $this->render('commande/index.html.twig',[
            'adresse'=>$adresse,
            'form'=>$form->createView(),
            'cart'=>$cart->getFull($voiture)
        ]);
    }

    #[Route('/commande/recapulatif', name: 'commande_recap')]
    public function add(Cart $cart,VoitureRepository  $voiture,Request $request,ManagerRegistry $doctrine): Response
    {
        $adresse = $this->getUser()->getAdresse();
        $form = $this->createForm(CommandeType::class);
        $mlivraison = "";
        $mpaiement = "";
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $date = new \DateTime();
            $modeLivraison = $form->get('Mode_de_Livraison')->getData();
            $modePaiement = $form->get('Mode_de_Paiement')->getData();
            $commande  = new Commande();
            $commande->setClient($this->getUser());
            $commande->setDateCommande($date);
            $commande->setModeLivraison($modeLivraison);
            $commande->setModePaiement($modePaiement);
            $commande->setAdresseLivraison($this->getUser()->getAdresse());
            $commande->setPaiementEffectue(0);
            $numCommande = 'NC-CLI-'.date('dmY').'-'.$this->getUser()->getId() ;
            $commande->setNumeroCommande($numCommande);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($commande);
            // enregistrer les voitures dans detail commande
            foreach ($cart->getFull($voiture) as $value)
            {
                $detailCommande = new DetailCommande() ;
                $detailCommande->setCommande($commande);
                $detailCommande->setVoiture($value['voiture']->getModele());
                $detailCommande->setQuantite($value['quantity']);
                $detailCommande->setPrix($value['voiture']->getPrix());
                $detailCommande->setTotal($value['voiture']->getPrix() * $value['quantity']);
                $entityManager->persist($detailCommande);
            }

            $mlivraison = $modeLivraison;
            $mpaiement = $modePaiement;
            //$entityManager->flush();
        }

        return $this->render('commande/add.html.twig',[
            'cart'=>$cart->getFull($voiture),
            'adresse'=>$adresse,
            'mlivraison'=>$mlivraison,
            'mpaiement'=>$mpaiement
        ]);
    }
}
