<?php

namespace Management\MeetingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TopicType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('speaker', 'entity', [
                'class' => 'Management\MeetingBundle\Entity\Speaker',
                'property' => 'name'
                ]
            )
            ->add('name', 'text',
                [
                'required' => true,
                'label' => 'meeting.topic.name'
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'meeting.topic.description'
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
            'data_class' => 'Management\MeetingBundle\Entity\Topic'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'topic';
    }
}
