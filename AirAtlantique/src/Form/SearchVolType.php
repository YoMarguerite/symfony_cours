<?php

namespace App\Form;

use App\Entity\Vol;
use App\Entity\Ville;
use App\Entity\Classe;
use App\Entity\SearchVol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchVolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date', DateType::class,[
                'widget' => 'single_text'])
            ->add('Depart', EntityType::class, [
                'label'         => 'Choisissez la ville de départ',
                'class'         => Ville::class,
                'choice_label'  => 'Nom',
                'multiple'      => false,
                'expanded'      => false,
                'attr'          => ["class" => "browser-default"],
            ])
            ->add('Arrivee', EntityType::class, [
                'label'         => 'Choisissez la ville d\'arrivée',
                'class'         => Ville::class,
                'choice_label'  => 'Nom',
                'multiple'      => false,
                'expanded'      => false,
                'attr'          => ["class" => "browser-default"],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchVol::class,
        ]);
    }
}
