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
            ->add('startDate', 'collot_datetime', array(
                'label' => 'organization.management.meeting.startDate',

                /** http://www.malot.fr/bootstrap-datetimepicker */
                'pickerOptions' =>
                array(

                    // 0 or 'hour' for the hour view
                    // 1 or 'day' for the day view
                    // 2 or 'month' for month view (the default)
                    // 3 or 'year' for the 12-month overview
                    // 4 or 'decade' for the 10-year overview. Useful for date-of-birth datetimepickers.


                    // p : meridian in lower case ('am' or 'pm') - according to locale file
                    // P : meridian in upper case ('AM' or 'PM') - according to locale file
                    // s : seconds without leading zeros
                    // ss : seconds, 2 digits with leading zeros
                    // i : minutes without leading zeros
                    // ii : minutes, 2 digits with leading zeros
                    // h : hour without leading zeros - 24-hour format
                    // hh : hour, 2 digits with leading zeros - 24-hour format
                    // H : hour without leading zeros - 12-hour format
                    // HH : hour, 2 digits with leading zeros - 12-hour format
                    // d : day of the month without leading zeros
                    // dd : day of the month, 2 digits with leading zeros
                    // m : numeric representation of month without leading zeros
                    // mm : numeric representation of the month, 2 digits with leading zeros
                    // M : short textual representation of a month, three letters
                    // MM : full textual representation of a month, such as January or March
                    // yy : two digit representation of a year
                    // yyyy : full numeric representation of a year, 4 digits

                    'format' => 'dd-mm-yyyy hh:ii',
                    'weekStart' => 0,

                    // The earliest date that may be selected; all earlier dates will be disabled
                    // 'startDate' => '01-01-2009',

                    // The latest date that may be selected; all later dates will be disabled.
                    // 'endDate' => '01-01-2050',
                    // Days of the week that should be disabled.
                    // Values are 0 (Sunday) to 6 (Saturday).
                    // Multiple values should be comma-separated.
                    // Example: disable weekends: '0,6' or [0,6].
                    // 'daysOfWeekDisabled' => '0,6',

                    // Whether or not to close the datetimepicker immediately when a date is selected.
                    'autoclose' => true,

                    // Number, String. Default: 2, 'month'
                    'startView' => 'month',

                    // Number, String. Default: 0, 'hour'
                    // The lowest view that the datetimepicker should show.
                    // 'minView' => 'hour',

                    // 'maxView' => 'year',
                    'todayBtn' => true,
                    'todayHighlight' => false,
                    'keyboardNavigation' => true,
                    'language' => 'pl',
                    'forceParse' => true,
                    'minuteStep' => 15,
                    'pickerReferer ' => 'default', //deprecated
                    'pickerPosition' => 'bottom-right',
                    'viewSelect' => 'hour',
                    'showMeridian' => 'month',
                    'initialDate' => date('d-m-Y H:i')
                    )
                )
            )
            // ->add('startDate', 'datetime', array(
            //     'label' => 'organization.management.meeting.startDate',
            //     'input'  => 'datetime',
            //     'widget' => 'choice',
            //     'placeholder' => array('year' => 'year', 'month' => 'month', 'day' => 'day')
            // ))
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
            ->add('description', 'textarea',
                [
                'required' => false,
                'label' => 'organization.management.meeting.description'
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
            ->add('facebookUrl', 'url',
                [
                'required' => false,
                'label' => 'organization.management.meeting.facebookUrl'
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
