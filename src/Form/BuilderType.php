<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Levels;
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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BuilderType extends AbstractType
{

    private $subClassesRepository;
    private $subRacesRepository;
    private $classesRepository;
    private $racesRepository;


    public function __construct(SubClassesRepository $subClassesRepository,
     SubRacesRepository $subRacesRepository,
     ClassesRepository $classesRepository,
     RacesRepository $racesRepository) 
     
    {
        $this->subClassesRepository = $subClassesRepository;
        $this->subRacesRepository = $subRacesRepository;
        $this->classesRepository = $classesRepository;
        $this->racesRepository = $racesRepository;

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de votre personnage'
            ])
            ->add('strength', IntegerType::class, [
                'label' => ' ',
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('dexterity', IntegerType::class, [
                'label' => ' ',
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('constitution', IntegerType::class, [
                'label' => ' ',
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('intelligence', IntegerType::class, [
                'label' => ' ',
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('wisdom', IntegerType::class, [
                'label' => ' ',
                'attr' => ['min' => 8, 'max' => 15]
            ])
            ->add('charisma', IntegerType::class, [
                'label' => ' ',
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
    ]
                     
            ])
             ->add('abilityScoreBonus2', ChoiceType::class, [
                'label'=> 'Bonus +1',
                
                'choices' => [
        'STR' => 'STR',
        'DEX' => 'DEX',
        'CON' => 'CON',
        'INT' => 'INT',
        'WIS' => 'WIS',
        'CHA' => 'CHA'
    ]
                
            ])
            ->add('idSubRace', ChoiceType::class, [
                'choices' => $this->subRacesRepository->findAll(),
                'choice_label' => 'name',
                'expanded' => true,
                'label'=> ' ',
                // 'attr' => ['class' => 'checkmark']
            ])
            ->add('idSubClasses', ChoiceType::class, [
                'choices' => $this->subClassesRepository->findAll(),
                'choice_label' => 'name',
                'expanded' => true,
                'label'=> ' ',
            ])
             ->add('idClasses', ChoiceType::class, [
                'choices' => $this->classesRepository->findAll(),
                'choice_label' => 'name',
                'expanded' => true,
                'label'=> ' ',
                'mapped'=>false,
                'required'=>false,
            ])
             ->add('idRaces', ChoiceType::class, [
                'choices' => $this->racesRepository->findAll(),
                'choice_label' => 'name',
                'expanded' => true,
                'label'=> ' ',
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('idUsers', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('idLevel', EntityType::class, [
                'class' => Levels::class,
                'choice_label' => 'id',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Character',
                'attr' => ['class' => 'btn mybtn']
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
