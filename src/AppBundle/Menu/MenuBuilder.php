<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

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

        $menu->addChild('Recherche', array('route' => 'locations_index'));

        return $menu;
    }

    public function createUserMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav navbar-nav pull-right');

        $menu->addChild('Se connecter', array('route' => 'fos_user_security_login'));

        $menu->addChild('S\'inscrire', array('route' => 'fos_user_registration_register'));
        // ... ajoutez ici les autres liens de base

        return $menu;
    }
}