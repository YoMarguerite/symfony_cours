<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Chaton;
use App\Entity\Proprietaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChatonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('photo', FileType::class, array('label' => 'Ajouter une photo', 'data_class' => null))
            ->add('categorie', EntityType::class, [
                'label'         => 'A quel catégorie appartient ce chaton ?',
                'class'         => Categorie::class,
                'choice_label'  => 'nom',
                'multiple'      => false,
                'expanded'      => false,
                'attr'          => ["class" => "browser-default"],
            ])
            ->add('proprietaire', EntityType::class, [
                'label'         => 'Qui est propriétaire de ce chaton ?',
                'class'         => Proprietaire::class,
                'choice_label'  => 'getNomEntier',
                'expanded'      => false,
                'multiple'      => true,
                'attr'          => ["class" => "browser-default", "style"=>"opacity:1 !important"],
            ])
            -> add('save', SubmitType::class, array('label' => 'Envoyer'
                , "attr" => ["class" => "waves-effect waves-light btn"]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chaton::class,
        ]);
    }
}
