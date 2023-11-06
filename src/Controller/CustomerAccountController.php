<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerAccountController extends AbstractController
{
    #[Route('/compteClient', name: 'customerAccount')]
    public function index(): Response
    {
        return $this->render('customer_account/index.html.twig');
    }
}
