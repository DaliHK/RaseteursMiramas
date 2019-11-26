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
            'label'=>'* Photo d\'identité',
            'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypesMessage' => 's\'il vous plait le document doit étre au format(jpg,bmp,jpeg,png)',
                    ])
                ],
            ])
            ->add('CertificatMedical', FileType::class,[
            'label'=>'* Certificat medical',
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
            'label'=>'* Droit d\'image',
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
            'label'=>'* Droit de transport',
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
            'label'=>'* Droit pratique',
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
            'label'=>'* Droit D\'entrainement',
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
            'label'=>'* Renseignements medicaux',
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
            'label'=>'* Renseignements genereaux',
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