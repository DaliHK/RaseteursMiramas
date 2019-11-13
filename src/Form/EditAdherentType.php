<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class EditAdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
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
            //->add('participationEvenement')
            ->add('submit', SubmitType::class, ['label' => 'Envoyez'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
