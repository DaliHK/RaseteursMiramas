<?php

namespace App\Form;

use App\Entity\ModeleDocument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class AdminDocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CertificatMedical', FileType::class,[
                //'mapped'=>false,
                'required'=> false,
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
               // 'mapped'=>false,
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
                   // 'mapped'=>false,
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
                     //   'mapped'=>false,
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
                     //   'mapped'=>false,
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
                    //    'mapped'=>false,
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
                    //    'mapped'=>false,
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
                
            // ->add('reglement')
            // ->add('statuts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModeleDocument::class,
        ]);
    }
}
