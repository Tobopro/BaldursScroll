<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('username', TextType::class, [
                'label' => "Your username"
            ])
            ->add('email', EmailType::class, [
                'label' => "Votre email"
            ])
            ->add('password', RepeatedType::class, [
                'type'          => PasswordType::class,
                'first_options' => [
                    'label' => 'Your password'
                ],
                'second_options' => [
                    'label' => 'Confirm your password'
                ],
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => 'the password should be 8 chars'
                    ]),
                ],
            ])
            ->add('profilePicture')
            ->add('save', SubmitType::class, [
                'label' => 'Submit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
