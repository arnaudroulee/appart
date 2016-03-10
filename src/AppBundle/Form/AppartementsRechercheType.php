<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AppartementsRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text', array('label' => 'Nom','required' => false));
        $builder->add('submit', 'submit');
        $builder->add('reset', 'submit');
    }

    public function getName()
    {
        return 'appartement_recherche';
    }
}