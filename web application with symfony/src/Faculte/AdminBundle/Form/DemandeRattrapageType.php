<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeRattrapageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateRattrapage')
            ->add('heure')
            ->add('matiere')
            ->add('filiere', EntityType::class, array(
                'class' => 'FaculteAdminBundle:Filiere',
                'mapped' => false,
                'placeholder' => 'Choisissez une filiere',
                'empty_data' => null,
                'required' => false,
                'multiple' => false))
            ->add('niveau', EntityType::class, array(
                'class' => 'FaculteAdminBundle:Niveau',
                'mapped' => false,
                'placeholder' => 'Choisissez un niveau',
                'empty_data' => null,
                'required' => false,
                'multiple' => false))
            ->add('groupe', EntityType::class, array(
                'class' => 'FaculteAdminBundle:Groupe',
                'mapped' => false,
                'placeholder' => 'Choisissez un groupe',
                'empty_data' => null,
                'required' => false,
                'multiple' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\DemandeRattrapage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faculte_adminbundle_demanderattrapage';
    }

    public function getName()
    {
        return "Faculte_Adminbundle_demanderattrapage";
    }


}
