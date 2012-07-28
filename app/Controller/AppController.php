<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session',
        'Menu'
    );

    public $helpers = array('Html', 'Form', 'Session');

    /**
     * beforeFilter is run before anything else
     */
    public function beforeFilter() {
        parent::beforeFilter();

        // Auth-settings
        $this->Auth->loginAction = array(
            'controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array(
            'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array(
            'controller' => '', 'action' => 'index');
    }

    /**
     * beforeRender is run before view the layout.
     */
    public function beforeRender() {
        parent::beforeRender();

        $menuArray = array(
            'Start' => array(
                'link' => '/',
                'access' => 'controllers/Index/display'
            ),

            'Användare' => array(
                'link' => '/users/',
                'access' => 'controllers/Users/index',
                'submenu' => array(
                    'Visa användare' => array(
                        'link' => '/users/',
                        'access' => 'controllers/Users/index',
                    ),
                    'Visa grupper' => array(
                        'link' => '/groups/',
                        'access' => 'controllers/Groups/index'
                    ),
                    'Skapa grupp' => array(
                        'link' => '/groups/add/',
                        'access' => 'controllers/Groups/add'
                    ),
                    'Visa registreringsnycklar' => array(
                        'link' => '/register_keys/',
                        'access' => 'controllers/RegisterKeys/index'
                    ),
                    'Skapa registreringsnyckel' => array(
                        'link' => '/register_keys/add/',
                        'access' => 'controllers/RegisterKeys/add'
                    ),
                    'Aclhanteraren' => array(
                        'link' => '/acl_managers/',
                        'access' => 'controllers/AclManagers/index'
                    )
                )
            ),
            'Logga ut' => array(
                'link' => '/users/logout',
                'access' => true
            )
        );

        if ($this->Auth->User('id') !== null)
        $this->set('menu', $this->Menu->generateMenu($menuArray));
    }

}
