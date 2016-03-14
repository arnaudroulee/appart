<?php

namespace Appart\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AppartementAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'nom'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('user')
            ->add('description', 'textarea', array('attr' => array('rows' => '10')))
            ->add('picture', 'sonata_media_type', array(
                'label' => 'Photo principale',
                'provider' => 'sonata.media.provider.image',
                'context'  => 'default',
                'required' => false,
                'show_unlink' => false,
                'compound' => true,
                //'cascade_validation' => true,
            ))
            ->add('adresse1', 'text', array('label' => 'Ligne adresse 1'))
            ->add('adresse2', 'text', array('label' => 'Ligne adresse 2', 'required' => false))
            ->add('cp', 'text', array('label' => 'Code postal'))
            ->add('ville')
            ->end()
            ->with('Galerie')
            ->add('gallery', 'sonata_type_model_list', array(
                'cascade_validation' => true,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'link_parameters' => array('provider' => 'sonata.media.provider.image'),
                    'admin_code' => 'sonata.media.admin.gallery',
                )
            )
            ->end()
            /*->add('gallery', 'sonata_type_collection', array(
                'by_reference' => false,
                'required' => false,
            ), array(
                'edit' => 'inline',
                'delete' => 'inline',
                'inline' => 'table'
            ))*/
            ->end()
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
            ->with('Informations générales')
                ->add('nom')
                ->add('description')
            ->end()
            ->with('Photos')
                ->add('photos')
            ->end()
        ;
    }

}