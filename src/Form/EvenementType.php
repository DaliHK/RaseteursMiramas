<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de l\'événement',
            ])
            ->add('lieu')
            ->add('dateDebut', DateType::class, [
                'label' => 'Date de début',
                'format' => 'ddMMyyyy'
            ])
            ->add('nombreParticipantMax')
            ->add('niveauRequis' ,ChoiceType::class, [
                'choices'  => [
                    'Cycle 1' => true,
                    'Cycle 2' => false
                ]])
            ->add('description')
            ->add('categorie')
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
