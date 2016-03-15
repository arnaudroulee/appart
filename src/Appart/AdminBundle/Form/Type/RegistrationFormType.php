<?php

namespace Appart\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as FosRegistrationFormType;

class RegistrationFormType extends FosRegistrationFormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('username');
        $builder
                ->add('firstname', null, array('label' => 'label_profile_firstname', 'translation_domain' => 'SonataUserBundle'))
                ->add('lastname', null, array('label' => 'label_profile_lastname', 'translation_domain' => 'SonataUserBundle'))
                ->add('gender', 'sonata_user_gender', array(
                    'label' => 'label_profile_gender',
                    'required' => true,
                    'translation_domain' => 'SonataUserBundle'
                ))
                ->add('phone', null, array('label' => 'label_profile_phone', 'translation_domain' => 'SonataUserBundle'));
    }

    public function getName()
    {
        return 'appart_admin_user_registration';
    }

}
