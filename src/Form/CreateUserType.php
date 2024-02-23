<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class CreateUserType extends EditUserType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::initForm($builder, $options);
        $builder

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => "Mot de passe"
                ],
                'second_options' => [
                    'label' => "Confirmez mot de passe"
                ],
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => "Met plus de caractères stp!",
                    ]),
                ]
            ])

            ->add('save', SubmitType::class, [
                'label' => "Enregistrer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
