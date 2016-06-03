<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomInformationRoomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('price', 'money', array(
            'label' => 'Prix',
            'currency' => 'TND',
            ))
        ->add('alreadyOneThere', 'checkbox', array(
                'label' => 'Il déja quelqun dans la chambre',
                'required' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\RoomInformationRoom'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_roominformationroom';
    }

    /**
     * @return \Pfa\MainBundle\Form\AdvertType
     */
    public function getParent()
    {
        return new RoomInformationType();
    }
}
