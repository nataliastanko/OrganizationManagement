<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

use libphonenumber\PhoneNumberFormat;

class SponsorType extends AbstractType
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
                'label' => 'organization.management.sponsor.name'
                ]
            )
            ->add('email', 'email',
                [
                'required' => false,
                'label' => 'organization.management.sponsor.email'
                ]
            )
            ->add('url', 'url',
                [
                'required' => true,
                'label' => 'organization.management.sponsor.url'
                ]
            )
            ->add('cities', 'entity',
                [
                'required' => true,
                'label' => 'organization.management.sponsor.cities',
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
            ->add('phoneNumber', 'tel',
                [
                    'label' => 'organization.management.sponsor.phoneNumber',
                    'required' => false,
                    'default_region' => 'PL', // GB
                    'format' => PhoneNumberFormat::INTERNATIONAL
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.sponsor.description'
                ]
            )
            ->add('resources', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.sponsor.resources'
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
            'data_class' => 'Organization\ManagementBundle\Entity\Sponsor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'organization_managementbundle_sponsor';
    }
}
