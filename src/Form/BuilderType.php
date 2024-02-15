<?php

namespace App\Form;

use App\Entity\Characters;
use App\Entity\Levels;
use App\Entity\SubClasses;
use App\Entity\SubRaces;
use App\Entity\User;
use App\Repository\SubClassesRepository;
use App\Repository\SubRacesRepository;
use App\Repository\ClassesRepository;
use App\Repository\RacesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('name')
            ->add('strength')
            ->add('dexterity')
            ->add('constitution')
            ->add('intelligence')
            ->add('wisdom')
            ->add('charisma')
            ->add('abilityScoreBonus1')
            ->add('abilityScoreBonus2')
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
                'mapped'=>false
            ])
             ->add('idRaces', ChoiceType::class, [
                'choices' => $this->racesRepository->findAll(),
                'choice_label' => 'name',
                'expanded' => true,
                'label'=> ' ',
                'mapped'=>false
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
