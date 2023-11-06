<?php

namespace App\Controller\Admin;

use App\Entity\Proprietaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProprietaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Proprietaire::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id','Id');
        yield TextField::new('prenom','Prénom');
        yield TextField::new('nom','Nom');
        yield TextField::new('email','Email');
        yield TextField::new('adresse','Adresse');
        yield TextField::new('telephone','Téléphone');
        yield TextField::new('ninea','Ninea');
        yield TextField::new('cni','Cni');
    }

    public function configureActions(Actions $actions): Actions
    {
        // return $actions->add(Crud::PAGE_INDEX,Action::DETAIL);
        return $actions
            ->disable(Action::NEW,Action::EDIT)
            ->add(Crud::PAGE_INDEX,Action::DETAIL);
    }

}
