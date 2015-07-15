<?php

namespace Management\MeetingBundle\Form;

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
                'label' => 'meeting.speaker.name'
                ]
            )
            ->add('lastName', 'text',
                [
                'required' => true,
                'label' => 'meeting.speaker.lastName'
                ]
            )
            ->add('bio', 'textarea',
                [
                'required' => false,
                'label' => 'meeting.speaker.bio'
                ]
            )
            // ->add('photo')
            ->add('phoneNumber', 'text',
                [
                'required' => false,
                'label' => 'meeting.speaker.phoneNumber'
                ]
            )
            ->add('email', 'email',
                [
                'required' => false,
                'label' => 'meeting.speaker.email'
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
            'data_class' => 'Management\MeetingBundle\Entity\Speaker'
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
