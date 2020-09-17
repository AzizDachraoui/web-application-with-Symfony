<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Faculte\AdminBundle\Form\UserType;

class EtudiantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CIN')
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', DateType::class, array(
                'placeholder' => array(
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                )
            ))
            ->add('lieuNaissance')
            ->add('sexe', ChoiceType::class, array(
                'choices' => array(
                    'Masculin' => 'M',
                    'Feminin' => 'F',

                )
            ))
            ->add('nationalite')
            ->add('telephone')
            ->add('adresse')
            ->add('filiere',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Filiere',
                'placeholder' => 'Choisissez une filière',
                'empty_data' => null,
                'mapped'=> false,
                'multiple'=> true,
                'required'=> true))
            ->add('groupe',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Groupe',
                'placeholder' => 'Choisissez un groupe',
                'empty_data' => null,
                'required'=> true))
            ->add('niveau',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Niveau',
                'placeholder' => 'Choisissez un niveau',
                'empty_data' => null,
                'mapped'=> false,
                'required'=> true))



        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\Etudiant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faculte_adminbundle_etudiant';
    }
    public function getName()
    {
        return 'Faculte_Adminbundle_etudiant ';
    }

}
