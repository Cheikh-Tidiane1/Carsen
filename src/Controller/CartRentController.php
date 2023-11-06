<?php

namespace App\Controller;

use App\Classe\CartRent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartRentController extends AbstractController
{
    #[Route('/cart/rent', name: 'cart_rent')]
    public function index(CartRent $cartRent): Response
    {

        return $this->render('cart_rent/index.html.twig',[
            $cartRent->get()
        ]);
    }

    #[Route('/cartRent/add/{id}', name: 'add_cart_rent')]
    public function add(CartRent $cartRent,$id): Response
    {
        $cartRent->add($id);
      return $this->redirectToRoute('cart_rent');
      //  return $this->render('cart_rent/index.html.twig');
    }

    #[Route('/cartRent/remove', name: 'remove_cart_rent')]
    public function remove(CartRent $cartRent): Response
    {
        $cartRent->remove();
        return $this->redirectToRoute('voitures');
        //  return $this->render('cart_rent/index.html.twig');
    }
}
