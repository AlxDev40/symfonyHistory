<?php

namespace App\Form;

use App\Entity\Battle;
use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BattleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom de la bataille.'
                ],
                'label' => 'Nom',
                'label_attr' => ['class' => 'col-form-label mt-4'],
            ])
            ->add('date', DateType::class, [
                'format' => 'dd-MMM-y',
                'label' => 'Date du début de la bataille.',
                'label_attr' => ['class' => 'col-form-label mt-4'],
            ])
            ->add('location', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez la localisation de la bataille.'
                ],
                'label' => 'Localisation',
                'label_attr' => ['class' => 'col-form-label mt-4'],
            ])
            ->add('characters', EntityType::class, [
                'class' => Character::class,
                'choice_label' => 'name',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Battle::class,
        ]);
    }
}
