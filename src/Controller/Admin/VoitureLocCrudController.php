<?php

namespace App\Controller\Admin;

use App\Entity\VoitureLoc;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VoitureLocCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoitureLoc::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('typeVoiture'),
            AssociationField::new('marque'),
            TextField::new('modele'),
            SlugField::new('slug')->setTargetFieldName('modele'),
            MoneyField::new('prix')
                ->setCurrency('XOF'),
            ImageField::new('photo')
                ->setBasePath('uploads/photoCarLoc')
                ->setUploadDir('public/uploads/photoCarLoc')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired('false'),
            DateField::new('dateDebutDispo')->setFormat('dd.MM.Y'),
            DateField::new('dateFinDispo')->setFormat('dd.MM.Y'),
            TextareaField::new('description')
        ];
    }

}
