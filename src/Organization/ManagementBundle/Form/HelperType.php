<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

use libphonenumber\PhoneNumberFormat;

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
            ->add('cities', 'entity',
                [
                'required' => true,
                'label' => 'organization.management.helper.cities',
                'class' => 'OrganizationManagementBundle:City',
                // 'class' => 'Organization\ManagementBundle\Entity\City',
                'property' => 'name',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function(EntityRepository $er) { // optional
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                ]
            )
            ->add('url', 'url',
                [
                'required' => false,
                'label' => 'organization.management.helper.url'
                ]
            )
            ->add('phoneNumber', 'tel',
                [
                    'label' => 'organization.management.helper.phoneNumber',
                    'required' => false,
                    'default_region' => 'PL', // GB
                    'format' => PhoneNumberFormat::INTERNATIONAL
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
