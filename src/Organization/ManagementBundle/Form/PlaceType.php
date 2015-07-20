<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

use libphonenumber\PhoneNumberFormat;

class PlaceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text',
                [
                'required' => true,
                'label' => 'organization.management.place.name'
                ]
            )
             ->add('city', 'entity', [
                'label' => 'form.city.label',
                'placeholder' => 'form.city.placeholder',
                'required' => true,
                'class' => 'Organization\ManagementBundle\Entity\City',
                'property' => 'name'
                ]
            )
            ->add('url', 'url',
                [
                'required' => false,
                'label' => 'organization.management.place.url'
                ]
            )
            ->add('facebookUrl', 'url',
                [
                'required' => false,
                'label' => 'organization.management.place.facebookUrl'
                ]
            )
            ->add('email', 'email',
                [
                'required' => false,
                'label' => 'organization.management.place.email'
                ]
            )

            ->add('phoneNumber', 'tel',
                [
                    'label' => 'organization.management.place.phoneNumber',
                    'required' => false,
                    'default_region' => 'PL', // GB
                    'format' => PhoneNumberFormat::INTERNATIONAL
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.place.description'
                ]
            )
            ->add('resources', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.place.resources'
                ]
            )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Organization\ManagementBundle\Entity\Place'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'place';
    }
}
