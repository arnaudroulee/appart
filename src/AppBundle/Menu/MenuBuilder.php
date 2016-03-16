<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class MenuBuilder
{

    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Recherche', array('route' => 'locations_index'))->setAttribute('icon', 'icon-search-1');

        return $menu;
    }

    public function createUserMenu(Request $request, SecurityContext $securityContext)
    {
        $menu = $this->factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav navbar-nav pull-right');


        if ($securityContext->isGranted('ROLE_USER')) {
            $menu->addChild('Mon profile', array('route' => 'fos_user_profile_edit'))->setAttribute('icon', 'icon-user');
            
            $menu->addChild('Se déconnecter', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'icon-lock-3');
        } else {
            $menu->addChild('S\'inscrire', array('route' => 'fos_user_registration_register'))->setAttribute('icon', 'icon-user-add');
            
            $menu->addChild('Se connecter', array('route' => 'fos_user_security_login'))->setAttribute('icon', 'icon-lock-open-1');
        }


        // ... ajoutez ici les autres liens de base

        return $menu;
    }

}
