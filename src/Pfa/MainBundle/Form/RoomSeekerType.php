<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomSeekerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('numberOfSeekers', 'choice', array(
            'label' => 'Nombres des demendeurs',
            'choices' => array(
                1=> '1',
                2=> '2',
                3=> '3',
                4=> '4',
                5=> '5'
                )
            ))
        ->add('selfPreference', new PreferenceType(), array(
            'label' => 'Preference des demandeurs'
            ))
        ->add('periodeToStay', 'choice', array(
            'label' => 'Periode de sejour',
            'choices' => array(
                1=> '1',
                2=> '2',
                3=> '3',
                4=> '4',
                5=> '5',
                6=> '6',
                7=> '7',
                8=> '8',
                9=> '9',
                10=> '10',
                11=> '11',
                12=> '12',
                0=> 'Le maximum possible'
                )
            )
        )
        ->add('budget', 'integer', array(
            'label' => 'Budget'
            ))
        ->add('radius', 'text')
        ->add("universitiesNotMapped", "text", array("mapped"=>false, 'label'=> 'Univérsités', 'required' => false));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\RoomSeeker'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_roomseeker';
    }

    /**
     * @return \Pfa\MainBundle\Form\AdvertType
     */
    public function getPArent()
    {
        return new AdvertType();
    }
}
