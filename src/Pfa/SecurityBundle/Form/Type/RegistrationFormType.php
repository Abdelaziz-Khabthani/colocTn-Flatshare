<?php

namespace Pfa\SecurityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle'))
            ->add('lastName', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle'))
            ->remove('username');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'pfa_user_registration';
    }
}
