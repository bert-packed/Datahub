<?php

namespace DataHub\SharedBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MenuBuilder
{
    private $factory;

    /**
     * Constructor
     * 
     * @param FactoryInterface $factory MenuFactory
     * @param AuthorizationCheckerInterface $authChecker Authentication checker
     */
    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authChecker, TokenStorageInterface $tokenStorage)
    // public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->authChecker = $authChecker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Defines the profile menu
     * 
     * @param Array $array
     */
    public function createProfileMenu(array $options) {
        $menu = $this->factory->createItem('root');

        if ($this->authChecker->isGranted('ROLE_USER') !== false) {
            $user = $this->tokenStorage->getToken()->getUser();
            $menu->addChild(sprintf('Howdy, %s', $user->getUsername()));
            $menu->addChild('Logout', array('route' => 'security_logout'));
        } else {
            $menu->addChild('Login', array('route' => 'security_login'));  
        }

        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');

        return $menu;
    }

    /**
     * Defines the MainMenu menu
     * 
     * @param Array $array
     */
    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Dashboard', array('route' => 'datahub_shared_default_index'));

       if ($this->authChecker->isGranted('ROLE_USER') !== false) {
           $menu->addChild('OAuth', array('route' => 'datahub_oauth_clients_index'));

           $menu['OAuth']->addChild('Clients', array('route' => 'datahub_oauth_clients_index', 'attributes' => array('class' => 'list-group-item')));
           $menu['OAuth']->addChild('Tokens', array('route' => 'datahub_oauth_tokens_index', 'attributes' => array('class' => 'list-group-item')));

            $menu->addChild('Administration', array('route' => 'datahub_user_users_index'));
            $menu['Administration']->addChild('Users', array('route' => 'datahub_user_users_index', 'attributes' => array('class' => 'list-group-item')));
       } 

        $menu->addChild('REST API', array('route' => 'nelmio_api_doc_index'));
        $menu->addChild('OAI-PMH', array('route' => 'datahub_static_docs_oai'));

        $menu->setChildrenAttribute('class', 'nav navbar-nav main-nav');

        return $menu;
    }
}