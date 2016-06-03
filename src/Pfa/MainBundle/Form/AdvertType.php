<?php

namespace Pfa\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('advertTitle', 'text', array(
                'label' => 'Titre'
                ))
            ->add('advertDescription', 'textarea', array(
'label' => 'Description',
                ))
            ->add('advertiserPhone', 'text', array(
                'label' => 'Numero Telephone',
                ))
            ->add('gmapLat', 'text')
            ->add('gmapLng', 'text')
            ->add('featureTv', 'checkbox', array(
                'label' => 'Tv',
                'required' => false,
            ))
            ->add('featureGardenTerrace', 'checkbox', array(
                'label' => 'Jardin ou terrace',
                'required' => false,
            ))
            ->add('featureParcking', 'checkbox', array(
                'label' => 'Parcking',
                'required' => false,
            ))
            ->add('featureFurnished', 'checkbox', array(
                'label' => 'Meublee',
                'required' => false,
            ))
            ->add('featureWifi', 'checkbox', array(
                'label' => 'WIFI',
                'required' => false,
            ))
            ->add('availableDate', 'date', array(
                'label' => 'Disponible le',
                'widget' => 'single_text'
                ))
            ->add('town', 'entity', array(
                'label' => 'Ville',
                'class' => 'PfaMainBundle:Town',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('targetPreference', new PreferenceWithoutGenderType(), array(
                'label' => 'Preference des nouveaux collocataires'
                ))
            ->add('album', new AlbumType());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfa\MainBundle\Entity\Advert'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfa_mainbundle_advert';
    }
}
