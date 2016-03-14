<?php

namespace Appart\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PhotoAdmin extends Admin
{

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'nom'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        if($this->hasParentFieldDescription()) { // this Admin is embedded
            // $getter will be something like 'getlogoImage'
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();

            // get hold of the parent object
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            if ($parent) {
                $image = $parent->$getter();
            } else {
                $image = null;
            }
        } else {
            $image = $this->getSubject();
        }


        $isNew = $image->isNew();

        $optionsFile = array('image_path' => 'webPath', 'required' => $isNew);
        $formMapper
            ->add('nom')
            ->add('principale', 'checkbox', array('label' => 'Photo principale', 'required' => false))
            ->add('active', 'checkbox', array('label' => 'Active', 'required' => true, 'attr' => array('checked'   => 'checked')))
            ->add('file', 'file', $optionsFile);
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('Image', null, array(
                'template' => 'AppartAdminBundle:Photo:picture.html.twig'
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
        ;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            /*case 'edit':
                return 'AppartAdminBundle:photo:base_edit.html.twig';
                break;*/
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}