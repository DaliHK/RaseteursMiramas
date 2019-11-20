<?php

namespace App\Form;

use App\Entity\SourcePhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class SourcePhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class)
            ->add('categorie',ChoiceType::class,[
                'choices' => [

                'Vie à l\'école' => 'vie_ecole',
                'Course camargaise' => 'course_camarguaise',
                'Autre' => 'Autre',
            
                ],
            ] )
            ->add('date',HiddenType::class,[
                
            ] )

            ->add('image',FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SourcePhoto::class,
        ]);
    }
}
