<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('niveaux',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Niveau',
                'required'=> true,
                'multiple'=>true,
                'placeholder' => 'Choisissez un niveau',
                'empty_data' => null))
            ->add('matiere',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Matiere',
                'required'=> true,
                'placeholder' => 'Choisissez une matiere',
                'empty_data' => null))
            ->add('filiere',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Filiere',
                'mapped'=> false,
                'required'=> true,
                'multiple'=> false,
                'placeholder' => 'Choisissez une filière',
                'empty_data' => null)

            )
            ->add('pathFile',FileType::Class);

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\Cour'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faculte_adminbundle_cour';
    }
        public function getName()
    {
        return "Faculte_adminbundle_cour";

    }


}
