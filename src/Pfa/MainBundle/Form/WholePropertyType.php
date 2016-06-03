<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WholePropertyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('roomsInformations', 'collection', array(
            'label' => 'Informations sur les chambres',
            'type'         => new RoomInformationWholePropertyType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false
            ))
        ->add('price', 'money', array(
            'label' => 'Prix',
            'currency' => 'TND',
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\WholeProperty'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_wholeproperty';
    }

    /**
     * @return \Pfa\MainBundle\Form\PropertyType
     */
    public function getParent()
    {
        return new PropertyType();
    }
}
