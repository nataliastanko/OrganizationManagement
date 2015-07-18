<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpeakerType extends AbstractType
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
                'label' => 'organization.management.speaker.name'
                ]
            )
            ->add('lastName', 'text',
                [
                'required' => true,
                'label' => 'organization.management.speaker.lastName'
                ]
            )
            ->add('bio', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.speaker.bio'
                ]
            )
            // ->add('photo')
            ->add('phoneNumber', 'text',
                [
                'required' => false,
                'label' => 'organization.management.speaker.phoneNumber'
                ]
            )
            ->add('email', 'email',
                [
                'required' => false,
                'label' => 'organization.management.speaker.email'
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
            'data_class' => 'Organization\ManagementBundle\Entity\Speaker'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'speaker';
    }
}
