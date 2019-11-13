<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('dateNaissance')
            ->add('dateInscription')
            ->add('email')
            ->add('telephone')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('numeroUrgence')
            ->add('statut')
            ->add('cotisationAsso')
            ->add('cotisationLicence')
            ->add('numLicence')
            ->add('dossierInscription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
