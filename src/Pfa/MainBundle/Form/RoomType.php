<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfCurrentMate', 'choice', array(
                'label' => 'Nombre actuel des collocataires',
                'choices' => array(
                    0=>'0',
                    1=> '1',
                    2=> '2',
                    3=> '3',
                    4=> '4',
                    5=> '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10'
                    )
                ))
            ->add('numberOfRoomsToRent', 'choice', array(
                'label' => 'Nombre des chambres a louer',
                'choices' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10
                    )
            ))
            ->add('roomsInformations', 'collection', array(
                'label' => 'Informations sur les chambres',
            'type'         => new RoomInformationRoomType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false
            ))
            ->add('advertiserType', 'entity', array(
                'label' => 'Vous êtes',
            'class' => 'PfaMainBundle:AdvertiserType',
            'choice_label' => 'name',
            'multiple' => false,
            'expanded' => false
            ))
            ->add('selfPreference',new PreferenceType(), array(
                'label' => 'Preference des collocataires actuel',
                ))
            ->add("universitiesNotMapped", "text", array("mapped"=>false, 'label'=> 'Univérsités', 'required' => false));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\Room'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_room';
    }

    /**
     * @return \Pfa\MainBundle\Form\PropertyType
     */
    public function getParent()
    {
        return new PropertyType();
    }
}
