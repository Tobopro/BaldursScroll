<?php

namespace App\Form;

use App\Entity\Characters;
use App\Entity\Levels;
use App\Entity\SubClasses;
use App\Entity\SubRaces;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuilderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('strength')
            ->add('dexterity')
            ->add('constitution')
            ->add('intelligence')
            ->add('wisdom')
            ->add('charisma')
            ->add('abilityScoreBonus1')
            ->add('abilityScoreBonus2')
            ->add('idSubRace', EntityType::class, [
                'class' => SubRaces::class,
'choice_label' => 'name',
            ])
            ->add('idSubClasses', EntityType::class, [
                'class' => SubClasses::class,
'choice_label' => 'name',
            ])
            ->add('idUsers', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('idLevel', EntityType::class, [
                'class' => Levels::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
