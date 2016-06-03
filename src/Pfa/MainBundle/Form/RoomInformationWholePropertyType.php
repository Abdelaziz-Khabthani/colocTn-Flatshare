<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomInformationWholePropertyType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\RoomInformationWholeProperty'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_roominformationwholeproperty';
    }

    /**
     * @return \Pfa\MainBundle\Form\AdvertType
     */
    public function getParent()
    {
        return new RoomInformationType();
    }
}
