<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'cart')]
    public function index(Cart $cart,ManagerRegistry $doctrine,VoitureRepository $voiture): Response
    {
        $cartComplete = [];
        if ($cart->get()){
            foreach ($cart->get() as $id => $quantity){
                $voiture_object = $voiture->findOneById($id);
                if(!$voiture_object)
                {
                    $cart->delete($id);
                    continue;
                }
                $cartComplete [] = [
                    'voiture' =>$voiture_object,
                    'quantity' => $quantity
                ];
            }
        }

        return $this->render('cart/index.html.twig',[
            'cart'=>$cartComplete
        ]);
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('voitures');
    }

    #[Route('/cart/delete/{id}', name: 'delete_to_cart')]
    public function delete(Cart $cart,$id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/decrease/{id}', name: 'decrease_to_cart')]
    public function decrease(Cart $cart,$id): Response
    {
        $cart->decrease($id);
        return $this->redirectToRoute('cart');
    }
}
