<?php

namespace Organization\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use libphonenumber\PhoneNumberFormat;

class UserType extends AbstractType
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
                'label' => 'user.name'
                ]
            )
            ->add('lastName', 'text',
                [
                'required' => true,
                'label' => 'user.lastName'
                ]
            )
            ->add('phoneNumber', 'tel',
                [
                    'label' => 'user.phoneNumber',
                    'required' => true,
                    'default_region' => 'PL', // GB
                    'format' => PhoneNumberFormat::INTERNATIONAL
                ]
            )
            ->add('city', 'entity', [
                'label' => 'user.form.city.label',
                'placeholder' => 'user.form.city.placeholder',
                'required' => true,
                'class' => 'Organization\ManagementBundle\Entity\City',
                'property' => 'name'
                ]
            )
            ->add('url', 'url',
                [
                'required' => true,
                'label' => 'user.url'
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
            'data_class' => 'Organization\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
