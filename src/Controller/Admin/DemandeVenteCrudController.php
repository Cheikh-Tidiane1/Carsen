<?php

namespace App\Controller\Admin;

use App\Entity\DemandeVente;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DemandeVenteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DemandeVente::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('proprietaire'),
            TextField::new('typevoiture'),
            TextField::new('marque'),
            TextField::new('modele'),
            TextField::new('etat'),
            MoneyField::new('prix')
                ->setCurrency('XOF'),
            ImageField::new('photo')
                ->setBasePath('uploads/photoCarAdmin')
                ->setUploadDir('public/uploads/photoCarAdmin')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired('false'),
            TextField::new('date')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        // return $actions->add(Crud::PAGE_INDEX,Action::DETAIL);
        return $actions
            ->disable(Action::NEW,Action::EDIT)
            ->add(Crud::PAGE_INDEX,Action::DETAIL);
    }
}
