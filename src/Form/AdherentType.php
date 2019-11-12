<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AdherentType extends AbstractType
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
        ->add('participation')
        ->add('submit',SubmitType::class, [
            'label'=>'Enregistrer'
        ])
    ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
