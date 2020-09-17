<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GroupeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveau', EntityType::class, array(
                'class' => 'FaculteAdminBundle:Niveau',
                'placeholder' => 'Choisissez une Niveau',
                'empty_data' => null))
            ->add('numGroupe')
            ->add('filiere', EntityType::class, array(
                    'class' => 'FaculteAdminBundle:Filiere',
                    'placeholder' => 'Choisissez une filière',
                    'empty_data' => null,
                    'mapped' => false,
                    'required' => true,
                    'multiple' => false)

            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\Groupe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faculte_adminbundle_groupe';
    }

    public function getName()
    {
        return 'Faculte_Adminbundle_groupe ';
    }


}
