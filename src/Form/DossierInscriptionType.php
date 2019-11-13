<?php

namespace App\Form;

use App\Entity\DossierInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DossierInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('photoIdentite', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre au format(jpg,bmp,jpeg,png)',
                    ])
                ],
            ])

            ->add('CertificatMedical', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
            ->add('DroitImage', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
            ->add('droitTransport', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
            ->add('droitPratique', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
            ->add('droitEntrainement', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
            ->add('renseignementsMedicaux', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
            ->add('renseignementsgeneraux', FileType::class,[
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre en PDF',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DossierInscription::class,
        ]);
    }
}
