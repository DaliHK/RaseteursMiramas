<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

class MotpasseoublierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class)
        ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
        ->add('submit', SubmitType::class, ['label' => 'Envoyez']);
    }
    
   // ->add('password', PasswordType::class, ['constraints' => [new UserPassword()]])


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array([
            'data_class' => Adherent::class,
        ]));
    }
}
