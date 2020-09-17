<?php

namespace Faculte\AdminBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('specialite')
            ->add('civilite', ChoiceType::class, array(
                'choices' => array(
                    'Masculin' => 'Homme',
                    'Feminin' => 'Femme',

                )
            ))
            ->add('adresse')
            ->add('ville', ChoiceType::class, array(
                'choices' => array(
                    'Nabeul' => 'Nabeul',
                    'Tunis' => 'Tunis',
                    'Monastir' => 'Monastir',
                    'Sousse' => 'Sousse',
                    'Jendouba' => 'Jendouba',
                    'Béja' => 'Béja',
                    'Ariana' => 'Ariana',
                    'Manouba' => 'Manouba',
                    'Ben arous' => 'Ben arous',
                    'Gafsa' => 'Gafsa',
                    'Bizerte' => 'Bizerte',
                    'Gabès' => 'Gabès',
                    'Kairouan' => 'Kairouan',
                    'Kasserine' => 'Kasserine',
                    'Kébili' => 'Kébili',
                    'Le Kef' => 'Le Kef',
                    'Mahdia' => 'Mahdia',
                    'Médenine' => 'Médenine',
                    'Sfax' => 'Sfax',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Siliana' => 'Siliana',
                    'Tataouine' => 'Tataouine',
                    'Tozeur' => 'Tozeur',
                    'Zaghouan' => 'Zaghouan',

                )
            ))
            ->add('telephone')
            ->add('dateNaissance',BirthdayType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Faculte\AdminBundle\Entity\Enseignant'
        ));
    }
    public function getName()
    {
        return 'Faculte_Adminbundle_enseignant';
    }

}
