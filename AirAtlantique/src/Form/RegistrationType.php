<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Mail')
            ->add('UserName')
            ->add('FirstName')
            ->add('Civilite', ChoiceType::class, [
                'choices'  => [
                    'Monsieur' => true,
                    'Madame' => false,
                ],
                'multiple' => false,
                'expanded' => false,
                'attr' => ['class' => 'browser-default'],
            ])
            ->add('Password', PasswordType::Class)
            ->add('ConfirmPassword', PasswordType::Class)
            ->add('save', SubmitType::class , array('label' => 'Validez'
            , "attr" => ["class" => "btn waves-effect waves-light red lighten-1"]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
