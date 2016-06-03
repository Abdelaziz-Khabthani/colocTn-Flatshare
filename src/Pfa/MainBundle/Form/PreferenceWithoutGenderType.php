<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreferenceWithoutGenderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->remove('ageSolo');
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
        return 'pfa_mainbundle_preferencewithoutgender';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return new PreferenceType();
    }
}
