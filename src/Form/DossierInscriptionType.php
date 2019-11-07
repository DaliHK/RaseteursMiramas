<?php

namespace App\Form;

use App\Entity\DossierInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DossierInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photoIdentite', FileType::class)
            ->add('CertificatMedical', FileType::class)
            ->add('DroitImage', FileType::class)
            ->add('droitTransport', FileType::class)
            ->add('droitPratique', FileType::class)
            ->add('droitEntrainement', FileType::class)
            ->add('renseignementsMedicaux', FileType::class)
            ->add('renseignementsgeneraux', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DossierInscription::class,
        ]);
    }
}
