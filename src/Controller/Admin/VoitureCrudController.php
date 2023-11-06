<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Configurator\TextEditorConfigurator;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('typevoiture'),
            AssociationField::new('typevoiture'),
            AssociationField::new('marque'),
            TextField::new('modele'),
            SlugField::new('slug')->setTargetFieldName('modele'),
            TextField::new('etat'),
            MoneyField::new('prix')
                ->setCurrency('XOF'),
            ImageField::new('photo')
                ->setBasePath('uploads/photoCarAdmin')
                ->setUploadDir('public/uploads/photoCarAdmin')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired('false'),
            TextareaField::new('description'),
            BooleanField::new('isBest')


        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX,Action::DETAIL);
    }
}
