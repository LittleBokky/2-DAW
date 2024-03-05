<?php

namespace App\Controller\Admin;

use App\Entity\Cancion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CancionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cancion::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('canciones_id'),
            TextField::new('title'),
            TextEditorField::new('description'),

            ImageField::new('Audio', 'Archivo de audio')
                ->setBasePath('/uploads/music')
                ->setUploadDir('public/uploads/music')
                ->hideOnIndex()
        ];
    }
    
}
