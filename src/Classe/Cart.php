<?php

namespace App\Classe ;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\RequestStack;


Class Cart
{

    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

    }

    public function add($id)
    {
        $cart = $this->requestStack->getSession()->get('cart',[]);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }

        $this->requestStack->getSession()->set('cart',$cart);
    }

    public function get()
    {
        return $this->requestStack->getSession()->get('cart');
    }

    public function remove()
    {
        return $this->requestStack->getSession()->remove('cart');
    }

    public function delete($id)
    {
        $cart = $this->requestStack->getSession()->get('cart',[]);
        unset($cart[$id]);
        return  $this->requestStack->getSession()->set('cart',$cart);
    }


    public function decrease($id)
    {

        $cart = $this->requestStack->getSession()->get('cart',[]);

        if ($cart[$id] > 1){
            $cart[$id]--;
        }else{
            unset($cart[$id]);
        }
        return  $this->requestStack->getSession()->set('cart',$cart);
    }

    public function getFull(VoitureRepository  $voiture)
    {
        $cartComplete = [];
        if ($this->get()){
            foreach ($this->get() as $id => $quantity){
                $voiture_object = $voiture->findOneById($id);
                if(!$voiture_object)
                {
                    $this->delete($id);
                    continue;
                }
                $cartComplete [] = [
                    'voiture' =>$voiture_object,
                    'quantity' => $quantity
                ];
            }
        }

        return $cartComplete;
    }


}

