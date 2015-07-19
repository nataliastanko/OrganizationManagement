<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PartnerType extends AbstractType
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
                'label' => 'organization.management.partner.name'
                ]
            )
            ->add('url', 'url',
                [
                'required' => true,
                'label' => 'organization.management.partner.url'
                ]
            )
            ->add('email', 'email',
                [
                'required' => false,
                'label' => 'organization.management.partner.email'
                ]
            )
            ->add('phoneNumber', 'text',
                [
                'required' => false,
                'label' => 'organization.management.partner.phoneNumber'
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.partner.description'
                ]
            )
            ->add('resources', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.partner.resources'
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
            'data_class' => 'Organization\ManagementBundle\Entity\Partner'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'partner';
    }
}
