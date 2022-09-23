<?php

namespace App\Form;

use App\Entity\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom du personnage'
                ],
                'label' => 'Nom',
                'label_attr' => ['class' => 'col-form-label mt-4'],
            ])
            ->add('birthDate', DateType::class, [
                'format' => 'dd-MMM-y',
                'label' => 'Date de naissance',
                'label_attr' => ['class' => 'col-form-label mt-4'],
            ])
            ->add('deathDate', DateType::class, [
                'format' => 'dd-MMM-y',
                'label' => 'Date de décès',
                'label_attr' => ['class' => 'col-form-label mt-4'],
            ]);
    }

    /*<div class="form-group">
  <label class="col-form-label mt-4" for="inputDefault">Default input</label>
  <input type="text" class="form-control" placeholder="Default input" id="inputDefault" data-dashlane-rid="a5ebfa49270d8876" data-form-type="other">
</div>*/

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
