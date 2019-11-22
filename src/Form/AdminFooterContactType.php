<?php

namespace App\Form;

use App\Entity\TexteFooterContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdminFooterContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'required'=> false,
                'label'=> 'Nom',
                 'attr'=>[
                     'placeholder'=> 'Nom'
                ]
              ])
            ->add('adresse', TextareaType::class,[
                'required'=> false,
                'label'=> 'Adresse',
                 'attr'=>[
                     'placeholder'=> 'Adresse'
                ]
              ])
            ->add('cp')
            ->add('ville')
            ->add('telephone1',TextType::class,[
                'label'=> 'Téléphone1',
              'attr'=>[
                'placeholder'=> 'Téléphone'
               ]
           ])
            ->add('telephone2',TextType::class,[
                'label'=> 'Téléphone2',
                'required'=>false,
              'attr'=>[
                'placeholder'=> 'Téléphone'
               ]
           ])
            ->add('email')
            ->add('submit', SubmitType::class,[
                'label'=>'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TexteFooterContact::class,
        ]);
    }
}
