<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreferenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pet','checkbox', array(
            'label' => 'Avec Animeaux',
            'required' => false,
            ))
        ->add('smocker','checkbox', array(
            'label' => 'Fumeur',
            'required' => false,
            ))
        ->add('gender', 'entity', array(
            'label' => 'Sexe',
            'class' => 'PfaMainBundle:Gender',
            'choice_label' => 'name',
            'multiple' => false,
            'expanded' => false
            ))
        ->add('universities', 'collection',array(
            'label' => 'Universites',
            'type'         => 'text',
            'allow_add'    => true,
            'allow_delete' => true
            ))
        ->add('ageSolo', 'choice', array(
            'label' => 'Age',
                'choices' => array(
                    18=> '18',
                    19=> '19',
                    20=> '20',
                    21=> '21',
                    22=> '22',
                    23 => '23',
                    24 => '24',
                    25 => '25',
                    26 => '26',
                    27 => '27',
                    28 => '28',
                    29 => '29',
                    29 => '29',
                    30 => '30',
                    31 => '31',
                    32 => '32',
                    33 => '33',
                    34 => '34',
                    35 => '35',
                    36 => '36',
                    37 => '37',
                    38 => '38',
                    39 => '39',
                    40 => '40'
                    )
                ))
        ->add('ageMin', 'choice', array(
            'label' => 'Age Minimum',
                'choices' => array(
                    18=> '18',
                    19=> '19',
                    20=> '20',
                    21=> '21',
                    22=> '22',
                    23 => '23',
                    24 => '24',
                    25 => '25',
                    26 => '26',
                    27 => '27',
                    28 => '28',
                    29 => '29',
                    29 => '29',
                    30 => '30',
                    31 => '31',
                    32 => '32',
                    33 => '33',
                    34 => '34',
                    35 => '35',
                    36 => '36',
                    37 => '37',
                    38 => '38',
                    39 => '39',
                    40 => '40'
                    )
                ))
        ->add('ageMax', 'choice', array(
            'label' => 'Age Maximum',
                'choices' => array(
                    18=> '18',
                    19=> '19',
                    20=> '20',
                    21=> '21',
                    22=> '22',
                    23 => '23',
                    24 => '24',
                    25 => '25',
                    26 => '26',
                    27 => '27',
                    28 => '28',
                    29 => '29',
                    29 => '29',
                    30 => '30',
                    31 => '31',
                    32 => '32',
                    33 => '33',
                    34 => '34',
                    35 => '35',
                    36 => '36',
                    37 => '37',
                    38 => '38',
                    39 => '39',
                    40 => '40'
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\Preference'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_preference';
    }
}
