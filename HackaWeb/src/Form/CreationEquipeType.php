<?php

namespace App\Form;

use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationEquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEquipe')
            ->add('dateInsc')
            ->add('numInsc')
            ->add('lesUtilisateur')
            ->add('leHackaton')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
