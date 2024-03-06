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
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('titulo'),
            TextField::new('autor'),
            TextField::new('genero'),

            ImageField::new('foto', 'Foto')
                ->setBasePath('/images')
                ->setUploadDir('public/images'),

            ImageField::new('audio', 'Archivo de audio')
                ->setBasePath('/public/music')
                ->setUploadDir('public/music')
                ->hideOnIndex()
        ];
    }
    
}
