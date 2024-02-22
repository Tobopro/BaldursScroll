<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Characters;
use App\Entity\Commentaries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            

            // ->add('text', null, [
            //     'label' => 'Votre commentaire',
            //     'attr' => ['class' => 'form-control'],
            // ])  
            ->add('response', EntityType::class, [
                'class' => Commentaries::class,
                'choice_label' => 'id',
            ])
            // ->add('save', SubmitType::class, [
            //     'label' => 'Répondre',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaries::class,
        ]);
    }
}
