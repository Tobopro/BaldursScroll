<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('username')
            ->add('email')
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
        $resolver->setDefaults([]);
    }
}
