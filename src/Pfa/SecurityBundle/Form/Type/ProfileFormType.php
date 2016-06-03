<?php

namespace Pfa\SecurityBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        $builder
            ->add('lastName', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle'))
            ->add('firstName', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle'))
            ->remove('username')
        ;
    }

    public function getName()
    {
        return 'pfa_user_profile';
    }
}