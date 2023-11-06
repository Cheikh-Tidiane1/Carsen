<?php

namespace App\Controller\Admin;

use App\Entity\DemandeLocation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DemandeLocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DemandeLocation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('proprietaire'),
            TextField::new('typevoiture'),
            TextField::new('marque'),
            TextField::new('modele'),
            DateTimeField::new('dateDebut')   ->setFormat('dd/MM/Y'),
            DateTimeField::new('DateFin')   ->setFormat('dd/MM/Y'),
            MoneyField::new('prix')
                ->setCurrency('XOF'),
            ImageField::new('photo')
                ->setBasePath('uploads/photoCarAdmin')
                ->setUploadDir('public/uploads/photoCarAdmin')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired('false')
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
