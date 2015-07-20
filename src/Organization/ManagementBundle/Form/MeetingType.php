<?php

namespace Organization\ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class MeetingType extends AbstractType
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
                'label' => 'organization.management.meeting.name'
                ]
            )
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.meeting.description'
                ]
            )
            ->add('city', 'entity',
                [
                'class' => 'Organization\ManagementBundle\Entity\City',
                'property' => 'name',
                'required' => true,
                'label' => 'form.city.label',
                'placeholder' => 'form.city.placeholder'
                ]
            )
            ->add('topics', 'entity',
                [
                'required' => false,
                'label' => 'organization.management.meeting.topics',
                'class' => 'OrganizationManagementBundle:Topic',
                'property' => 'fullname',
                'expanded' => false,
                'multiple' => true,
                'query_builder' => function(EntityRepository $er) { // optional
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                ]
            )
            ->add('sponsors', 'entity',
                [
                'required' => false,
                'label' => 'organization.management.meeting.sponsors',
                'class' => 'OrganizationManagementBundle:Sponsor',
                'property' => 'name',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function(EntityRepository $er) { // optional
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                ]
            )
            ->add('partners', 'entity',
                [
                'required' => true,
                'label' => 'organization.management.meeting.partners',
                'class' => 'OrganizationManagementBundle:Partner',
                'property' => 'name',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function(EntityRepository $er) { // optional
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                ]
            )
            ->add('ticketsUrl', 'text',
                [
                'required' => false,
                'label' => 'organization.management.meeting.ticketsUrl'
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
            'data_class' => 'Organization\ManagementBundle\Entity\Meeting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'organization_managementbundle_meeting';
    }
}
