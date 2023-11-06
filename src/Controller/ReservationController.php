<?php

namespace App\Controller;

use App\Classe\CartRent;
use App\Classe\SearchRent;
use App\Entity\DetailReservation;
use App\Entity\Reservation;
use App\Entity\VoitureLoc;
use App\Form\ReservationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ReservationController extends AbstractController
{


    #[Route('/reservation/{dateDebut}/{dateFin}/{nombreDeJour}/{id}', name: 'reservation')]
    public function index(ManagerRegistry $doctrine,$dateDebut,$dateFin,$nombreDeJour,$id, Request $request): Response
    {
        $voitureloc = $doctrine->getRepository(VoitureLoc::class)->findOneById($id);
        $adresse = $this->getUser()->getAdresse();
        $form = $this->createForm(ReservationType::class);

      /*  $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
        }
      */

        return $this->render('reservation/index.html.twig',[
            'dateDebut'=> $dateDebut,
            'dateFin'=> $dateFin,
            'nombreDeJour'=> $nombreDeJour,
            'form'=> $form->createView(),
            'adresse'=>$adresse,
            'voitureloc'=>$voitureloc

        ]);
    }

    #[Route('/reservation/recapitulatif/{dateDebut}/{dateFin}/{nombreDeJour}/{id}/{prixJour}/{modele}', name: 'reservationRecap')]
    public function add(ManagerRegistry $doctrine,$dateDebut,$dateFin,$nombreDeJour,$id,$prixJour,$modele, Request $request): Response
    {
        $voitureloc = $doctrine->getRepository(VoitureLoc::class)->findOneById($id);
        $adresse = $this->getUser()->getAdresse();
        $form = $this->createForm(ReservationType::class);
        $mlivraison = "";
        $mpaiement = "";

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $date = new \DateTime();
            $reservation = new Reservation();
            $reservation->setClient($this->getUser());
            $reservation->setDateReservation($date);
            $reservation->setModeLivraison($form->get('Mode_de_Livraison')->getData());
            $reservation->setModePaiement($form->get('Mode_de_Paiement')->getData());
            // formater la date(string) en dateTimeInterface
            $dDebut = strtotime($dateDebut);
            $dFin = strtotime($dateFin);
            $formatdDebut = date('Y-m-d',$dDebut);
            $formatdFin = date('Y-m-d',$dFin);
            $reservation->setDateDebut(new \DateTime($formatdDebut));
            $reservation->setDateFin(new \DateTime($formatdFin));
            $reservation->setAdresseLivraison($this->getUser()->getAdresse());
            $reservation->setPaiementEffectue(0);
            $reservation->setNumeroReservation('RS-CLI-'.date('dmY').'-'.$this->getUser()->getId());

            $entityManager = $doctrine->getManager();
            $entityManager->persist($reservation);

            $detailReservation = new DetailReservation();
            $detailReservation->setReservation($reservation);
            $detailReservation->setPrixJour($prixJour);
            $detailReservation->setNombreJour($nombreDeJour);
            $detailReservation->setVoiture($modele);
            $detailReservation->setTotal($prixJour * $nombreDeJour);
            $entityManager->persist($detailReservation);


            $mlivraison = $form->get('Mode_de_Livraison')->getData();
            $mpaiement = $form->get('Mode_de_Paiement')->getData();

           // $entityManager->flush();

             // dd($form->getData());
        }

        return $this->render('reservation/recap.html.twig',[
            'dateDebut'=> $dateDebut,
            'dateFin'=> $dateFin,
            'nombreDeJour'=> $nombreDeJour,
            'mlivraison'=>$mlivraison,
            'mpaiement'=>$mpaiement,
            'adresse'=>$adresse,
            'voitureloc'=>$voitureloc


        ]);
    }
}
