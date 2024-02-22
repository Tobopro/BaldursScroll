<?php

namespace App\Form;

use App\Entity\Characters;
use App\Entity\Commentaries;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text')
            ->add('createdAt')
            ->add('Author', EntityType::class, [
                'class' => User::class,
            'choice_label' => 'id',
            ])
            ->add('Build', EntityType::class, [
                'class' => Characters::class,
            'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaries::class,
        ]);
    }
}
