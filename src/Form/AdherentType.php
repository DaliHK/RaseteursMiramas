<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('roles')
            ->add('password', RepeatedType::class, [
               'type' => PasswordType::class,
               'invalid_message' => 'Les mots de passe doivent être identiques.',
               'options' => ['attr' => ['class' => 'password-field']],
               'required' => true,
               'first_options'  => ['label' => 'Password'],
               'second_options' => ['label' => 'Repeat Password']])
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', BirthdayType::class, [
                'format' => 'ddMMyyyy',
                'placeholder' => '',
            ])  
            ->add('dateInscription', DateType::class, [
                'format' => 'ddMMyyyy',
                'required' => false,
                'empty_data' => null
                ])
            ->add('email')
            ->add('telephone',['attr' => ['maxlength' => 10]])
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('numeroUrgence')
            ->add('nomUrgence')
            ->add('niveau')
            ->add('statut')
            ->add('cotisationAsso')
            ->add('cotisationLicence')
            ->add('numLicence')
            ->add('dossierInscription')
            ->add('submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
