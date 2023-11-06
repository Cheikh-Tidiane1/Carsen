<?php

namespace App\Controller\Admin;

use App\Entity\Administrateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdministrateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Administrateur::class;
    }


   /* public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('prenom'),
            TextField::new('nom'),
            EmailField::new('email'),
            EmailField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class),
            TextField::new('adresse')
        ];
    }
   */
}
