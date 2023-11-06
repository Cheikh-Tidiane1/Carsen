<?php

namespace App\Classe ;

use Symfony\Component\HttpFoundation\RequestStack;

class CartRent
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

    }


    public function add($id)
    {
        $cartRent = $this->requestStack->getSession()->get('cartRent',[]);
        if(!empty($cartRent[$id])){
            $cartRent[$id]++;
        }else{
            $cartRent[$id] = 1;
        }

        $this->requestStack->getSession()->set('cartRent',$cartRent);
    }

    public function get()
    {
        return $this->requestStack->getSession()->get('cartRent');
    }

    public function remove()
    {
        return $this->requestStack->getSession()->remove('cartRent');
    }

}