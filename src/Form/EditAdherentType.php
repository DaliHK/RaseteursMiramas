<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class EditAdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* ->add('username') */
            /* ->add('roles') */
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            ->add('nom')
            ->add('prenom')
           /*  ->add('dateNaissance')
            ->add('dateInscription') */
            ->add('email',EmailType::class)
            ->add('telephone',NumberType::class)
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('numeroUrgence',NumberType::class)

            /* ->add('statut')
            ->add('cotisationAsso')
            ->add('cotisationLicence')
            ->add('numLicence')
            ->add('dossierInscription')
            ->add('participation') */
            ->add('')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
