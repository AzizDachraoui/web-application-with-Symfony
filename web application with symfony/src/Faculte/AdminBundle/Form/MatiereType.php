<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveaux',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Niveau',
                'required'=> true,
                'multiple'=>true,
                'placeholder' => 'Choisissez des niveaux',
                'empty_data' => null))
            ->add('nom')
            ->add('filiere',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Filiere',
                'mapped'=> false,
                'required'=> true,
                'placeholder' => 'Choisissez une filière',
                'empty_data' => null))
            ->add('enseignants',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Enseignant',
                'required'=> true,
                'multiple'=> true))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\Matiere'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "Faculte_Adminbundle_matiere";
    }



}
