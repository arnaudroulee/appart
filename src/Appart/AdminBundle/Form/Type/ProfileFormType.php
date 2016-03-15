<?php

namespace Appart\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as FosRegistrationFormType;

class ProfileFormType extends FosRegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('username');
    }
    
    public function getName()
    {
        return 'appart_admin_user_profile';
    }

}
