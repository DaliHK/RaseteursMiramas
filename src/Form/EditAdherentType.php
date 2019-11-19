<?php

namespace App\Form;



use App\Entity\Adherent;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EditAdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            /* ->add('username') */
            /* ->add('roles') */
           ->add('password', RepeatedType::class, [
               'type' => PasswordType::class,
               'invalid_message' => 'Les mots de passe doivent être identiques.',
               'options' => ['attr' => ['class' => 'password-field']],
               'required' => true,
               'first_options'  => ['label' => 'Password'],
               'second_options' => ['label' => 'Repeat Password']])
            ->add('nom')
            ->add('prenom')
            //->add('dateNaissance', DateType::class, [
             //   'required' => false,
             //   'empty_data' => null
             //   ])
            //->add('dateInscription', DateType::class, [
             //'required' => false,
            //'empty_data' => null
              //])
            ->add('email',EmailType::class)
            ->add('telephone',NumberType::class)
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('numeroUrgence',NumberType::class)
            ->add('nomUrgence',TextType::class)
            //->add('statut')
            //->add('cotisationAsso')
            //->add('cotisationLicence')
            //->add('numLicence')
            //->add('dossierInscription')
            //->add('submit', SubmitType::class, ['label' => 'Envoyez'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
