<?php

namespace Organization\MeetingBundle\Form;

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
                'class' => 'Organization\MeetingBundle\Entity\Speaker',
                'property' => 'name'
                ]
            )
            ->add('name', 'text',
                [
                'required' => true,
                'label' => 'organization.topic.name'
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.topic.description'
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
            'data_class' => 'Organization\MeetingBundle\Entity\Topic'
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
