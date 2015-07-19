<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HelperType extends AbstractType
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
                'label' => 'organization.management.helper.name'
                ]
            )
            ->add('lastName', 'text',
                [
                'required' => true,
                'label' => 'organization.management.helper.lastName'
                ]
            )
            ->add('url', 'url',
                [
                'required' => false,
                'label' => 'organization.management.helper.url'
                ]
            )
            ->add('phoneNumber', 'text',
                [
                'required' => false,
                'label' => 'organization.management.helper.phoneNumber'
                ]
            )
            ->add('email', 'email',
                [
                'required' => false,
                'label' => 'organization.management.partner.email'
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.helper.description'
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
            'data_class' => 'Organization\ManagementBundle\Entity\Helper'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'helper';
    }
}
