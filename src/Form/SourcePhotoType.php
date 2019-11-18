<?php

namespace App\Form;

use App\Entity\SourcePhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SourcePhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class)
            ->add('categorie',ChoiceType::class,[
                'choices' => [

                'vie_ecole' => 'vie ecole',
                'course_camarguaise' => 'course_camaguaise',
                '$ilustration_agenda' => 'ilustration_agenda',
            
                ],
            ] )
            ->add('date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SourcePhoto::class,
        ]);
    }
}
