<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PropertyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', 'text', array(
                'label' => 'Adresse'
                ))
            ->add('postcode', 'integer', array(
                'label' => 'Code Postal'
                ))
            ->add('minimumStay', 'choice', array(
                'label' => 'Duree minimum de sejour',
                'choices' => array(
                    1 =>  '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                    11 => '11',
                    12 => '12'
                    )
            ))
            ->add('maximumStay', 'choice', array(
                'label' => 'Duree maximal de sejour',
                'choices' => array(
                    1 =>  '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                    11 => '11',
                    12 => '12',
                    0 => 'Le maximum possible'
                    )
            ))
            ->add('numberOfTotalRooms', 'choice', array(
                'label' => 'Nombre total des chambres',
                'choices' => array(
                    1 =>  '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10'
                    )
            ))
            ->add('factureFree', 'checkbox', array(
                'label' => 'Factures inclus',
                'required' => false,
            ))
            ->add('propertyType', 'entity', array(
                'label' => 'Type de propriete',
                'class' => 'PfaMainBundle:PropertyType',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ))
            ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\Property'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_property';
    }

    /**
     * @return \Pfa\MainBundle\Form\AdvertType
     */
    public function getParent()
    {
        return new AdvertType();
    }
}
