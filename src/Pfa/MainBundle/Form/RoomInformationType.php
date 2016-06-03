<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomInformationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size', 'entity', array(
                'label' => '__name__label__',
                'class' => 'PfaMainBundle:RoomSize',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('suite', 'checkbox', array(
                'label' => 'Suite',
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
            'data_class' => 'Pfa\MainBundle\Entity\RoomInformation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_roominformation';
    }
}
