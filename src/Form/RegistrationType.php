<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('prenom', TextType::class, ['label' => 'Prénom'])
        ->add('username', TextType::class, ['label' => 'Pseudo'])
       // ->add('roles')
       ->add('submit', SubmitType::class, ['label' => 'Envoyez'])
        ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
        ->add('confirm_password', PasswordType::class, ['label' => 'Confirmez le mot de passe'])
        ->add('dateNaissance', DateType::class, [
            'widget' => 'single_text',
        
            // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => false,
        
            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
        ])      
        ->add('email')
        ->add('telephone', TextType::class, ['label' => 'Téléphone'])
        ->add('adresse')
        ->add('cp', TextType::class, ['label' => 'Code Postal'])
        ->add('ville');
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
