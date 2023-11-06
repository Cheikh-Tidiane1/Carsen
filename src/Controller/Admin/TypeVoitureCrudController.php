<?php

namespace App\Controller\Admin;

use App\Entity\TypeVoiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeVoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeVoiture::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
