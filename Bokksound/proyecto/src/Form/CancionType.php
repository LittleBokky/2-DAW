<?php

namespace App\Form;

use App\Entity\Cancion;
use App\Entity\Playlist;
use App\Form\DataTransformer\StringToFile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CancionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('autor')
            ->add('genero')
            ->add('foto', FileType::class)
            ->add('audio', FileType::class)
            // ->add('playlists', EntityType::class, [
            //     'class' => Playlist::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
                
            //])
            ;

        $builder->get('foto')->addModelTransformer(new StringToFile());
        $builder->get('audio')->addModelTransformer(new StringToFile());
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cancion::class,
        ]);
    }
}
