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
                    'label' => "Password"
                ],
                'second_options' => [
                    'label' => "Password confirmation"
                ],
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => "You need more than 8 characters for your password",
                    ]),
                ]
            ])

            ->add('save', SubmitType::class, [
                'label' => "Save"
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
