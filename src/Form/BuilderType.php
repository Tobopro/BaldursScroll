<?php

namespace App\Form;

use App\Entity\Races;
use App\Entity\Levels;
use App\Entity\Classes;
use App\Entity\SubRaces;
use App\Entity\Characters;
use App\Entity\SubClasses;
use App\Repository\RacesRepository;
use App\Repository\ClassesRepository;
use App\Repository\SubRacesRepository;
use App\Repository\SubClassesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BuilderType extends AbstractType
{

    private $subClassesRepository;
    private $subRacesRepository;
    private $classesRepository;
    private $racesRepository;


    public function __construct(
        ClassesRepository $classesRepository,
        SubClassesRepository $subClassesRepository,
        RacesRepository $racesRepository,
        SubRacesRepository $subRacesRepository
    )
    {
        $this->classesRepository = $classesRepository;
        $this->subClassesRepository = $subClassesRepository;
        $this->racesRepository = $racesRepository;
        $this->subRacesRepository = $subRacesRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("idClasses", EntityType::class, [
                "class" => Classes::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                "required" => false,
                "placeholder" => "Choose a class",
            ])
            ->add("idSubClasses", EntityType::class, [
                "class" => SubClasses::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                "required" => false,
                "placeholder" => "Choose a subclass",
                "attr" => ["name" => "subclasses"]
            ])
            ->add("idRaces", EntityType::class, [
                "class" => Races::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                "required" => false,
                "placeholder" => "Choose a race",
            ])
            ->add("idSubRace", EntityType::class, [
                "class" => SubRaces::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                "required" => false,
                "placeholder" => "Choose a subrace",
            ])
            ->add('strength', IntegerType::class, [
                'label' => false,
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('dexterity', IntegerType::class, [
                'label' => false,
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('constitution', IntegerType::class, [
                'label' => false,
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('intelligence', IntegerType::class, [
                'label' => false,
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('wisdom', IntegerType::class, [
                'label' => false,
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('charisma', IntegerType::class, [
                'label' => false,
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('abilityScoreBonus1', ChoiceType::class, [
               'label'=> 'Bonus +2',
               'choices' => [
                    'STR' => 'STR',
                    'DEX' => 'DEX',
                    'CON' => 'CON',
                    'INT' => 'INT',
                    'WIS' => 'WIS',
                    'CHA' => 'CHA'
                ],
                'attr' => ['class' => 'w-75']
            ])
            ->add('abilityScoreBonus2', ChoiceType::class, [
                'label'=> 'Bonus +1',
                'choices' => [
                    'STR' => 'STR',
                    'DEX' => 'DEX',
                    'CON' => 'CON',
                    'INT' => 'INT',
                    'WIS' => 'WIS',
                    'CHA' => 'CHA',
                ],
                'attr' => ['class' => 'w-75']
            ])
            ->add('idLevel', EntityType::class, [
                'class' => Levels::class,
                'label' => "Character's level",
                'choice_label' => 'id',
            ])
            ->add('name', TextType::class, [
                'label' => "Character's name",
                "constraints" => new NotBlank(["message" => "Enter the character's name"]),
            ])
            ->add('isPublic', CheckboxType::class, [
                'label' => 'Make my character public',
                'required' => false,
                'data' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Character',
                'attr' => ['class' => 'btn mybtn'],
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
