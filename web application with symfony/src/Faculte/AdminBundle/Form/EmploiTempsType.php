<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EmploiTempsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('groupe',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Groupe',
                'placeholder' => 'Choisissez un Groupe',
                'empty_data' => null))
            ->add('niveau',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Niveau',
                'placeholder' => 'Choisissez un niveau',
                'empty_data' => null,
                'mapped'=> false,
                'required'=> true))
            ->add('filiere',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Filiere',
                'mapped'=> false,
                'required'=> true,
                'placeholder' => 'Choisissez une Filière',
                'empty_data' => null))


            ->add('pathFile',FileType::Class) ;
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\EmploiTemps'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faculte_adminbundle_emploitemps';

    }

    public function getName()
    {
        return "Faculte_Adminbundle_emploitemps";
    }
}
