<?php

// Cette classe sert à afficher les informations éditables de l'adhérent lorsqu'il se connecte a son profil

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AdminEditAdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
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
            ->add('email',EmailType::class)
            ->add('telephone')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('numeroUrgence')
            ->add('statut',ChoiceType::class, [
                'choices'  => [
                   
                    'Inscrit' => true,
                    'Pré-inscrit' => false
                ]])
            ->add('nomUrgence')
            ->add('niveau',ChoiceType::class, [
                'choices'  => [
                    'cycle 2' => true,
                    'cycle 1' => false
                ]])
            ->add('cotisationAsso')
            ->add('cotisationLicence')
            ->add('numLicence')
           //->add('dossierInscription')
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
