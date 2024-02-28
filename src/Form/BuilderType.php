<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Levels;
use App\Entity\SubRaces;
use App\Entity\Characters;
use App\Entity\Classes;
use App\Entity\Races;
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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            // ->add('idClasses', ChoiceType::class, [
            //     'choices' => $this->classesRepository->findAll(),
            //     'choice_label' => 'name',
            //     'expanded' => true,
            //     'label'=> ' ',
            //     'mapped'=>false,
            //     'required'=>false,
            // ])
            // ->add('idSubClasses', ChoiceType::class, [
            //     'choices' => $this->subClassesRepository->findAll(),
            //     'choice_label' => 'name',
            //     'expanded' => true,
            //     'label'=> ' ',
            // ])
            ->add("idClasses", EntityType::class, [
                "class" => Classes::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                // "mapped" => false,
                "required" => false,
                "placeholder" => "Choose a class",
                // "query_builder" => $this->classesRepository->createQueryBuilder("c")->orderBy("c.name", "ASC"),
            ])
            ->add("idSubClasses", EntityType::class, [
                "class" => SubClasses::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                // "mapped" => false,
                "required" => false,
                "placeholder" => "Choose a subclass",
                // "disabled" => true,
                // "query_builder" => $this->subClassesRepository->createQueryBuilder("c")
                //     ->andWhere("c.idClass := 'class'")
                //     ->setParameter("class", $this->get)
                //     ->orderBy("c.name", "ASC")
            ])
            ->add("idRaces", EntityType::class, [
                "class" => Races::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                // "mapped" => false,
                "required" => false,
                "placeholder" => "Choose a race",
                // "query_builder" => $this->classesRepository->createQueryBuilder("c")->orderBy("c.name", "ASC"),
            ])
            ->add("idSubRace", EntityType::class, [
                "class" => SubRaces::class,
                "choice_label" => 'name',
                "expanded" => true,
                "label" => false,
                // "mapped" => false,
                "required" => false,
                "placeholder" => "Choose a subrace",
                // "disabled" => true,
                // "query_builder" => $this->subClassesRepository->createQueryBuilder("c")
                //     ->andWhere("c.idClass := 'class'")
                //     ->setParameter("class", $this->get)
                //     ->orderBy("c.name", "ASC")
            ])
            // ->add('idRaces', ChoiceType::class, [
            //     'choices' => $this->racesRepository->findAll(),
            //     'choice_label' => 'name',
            //     'expanded' => true,
            //     'label'=> ' ',
            //     'mapped'=>false,
            //     'required'=>false,
            // ])
            // ->add('idSubRace', ChoiceType::class, [
            //     'choices' => $this->subRacesRepository->findAll(),
            //     'choice_label' => 'name',
            //     'expanded' => true,
            //     'label'=> ' ',
            //     // 'attr' => ['class' => 'checkmark']
            // ])
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
                'label' => 'Character\'s level',
                'choice_label' => 'id',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom de votre personnage',
                "constraints" => new NotBlank(["message" => "Enter the character's name"]),
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Character',
                'attr' => ['class' => 'btn mybtn'],
            ])
            // ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            //     // $event->getData()
            //     //     ->setName("Gandalf")
            //     //     ->setIntelligence(12)
            //     //     ->setIdSubClasses($this->subClassesRepository->find(5))
            //     // ;
            //     // $event->getForm()->get("idClasses")->getConfig()->data = $this->classesRepository->find(1);
            //     $event->getForm()->add("idSubClasses", ChoiceType::class, [
            //         "choices" => $this->classesRepository->find(1)->getSubClasses(),
            //         "choice_label" => 'name',
            //         "expanded" => true,
            //         "label" => false,
            //         // "mapped" => false,
            //         "required" => false,
            //         "placeholder" => "Choose a subclass",
            //         // "disabled" => true,
            //         // "query_builder" => $this->subClassesRepository->createQueryBuilder("c")->andWhere("c.idClass := 'class'")->setParameter("class", 1)
            //     ]);
            //     // dd($event->getForm()->get("idClasses")->getConfig()->data);
            // })
            // ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
            //     dump($event->getData());
            // })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
