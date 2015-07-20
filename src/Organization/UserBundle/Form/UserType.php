<?php

namespace Organization\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('phoneNumber', 'text',
                [
                'required' => true,
                'label' => 'user.phoneNumber'
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
