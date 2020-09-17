<?php

namespace Faculte\AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultatEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('filiere',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Filiere',
                'mapped'=> false,
                'required'=> true,
                'multiple'=> false))
            ->add('niveau',EntityType::class, array(
                'class'=>'FaculteAdminBundle:Niveau',
                'required'=> true));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\Resultat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faculte_adminbundle_resultat';
    }
        public function getName()
    {
        return "Faculte_adminbundle_resultat";

    }


}
