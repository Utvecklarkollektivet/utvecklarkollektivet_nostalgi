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
			
		// Always keep user and acl as variables in the views
		$this->set('user', $this->Auth->user());    
		$this->set('acl', $this->Acl);
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
            
            'Forum' => array(
                'link' => '/forums/',
                'access' => true
            ),

            'Logga ut' => array(
                'link' => '/users/logout',
                'access' => true
            )
        );

        if ($this->Auth->User('id') !== null)
        $this->set('menu', $this->Menu->generateMenu($menuArray));
    }
	
	/**
	 * Generate bredcrumb for view depending on which view the users is in
	 * Type 0 = Forumgroup
	 * Type 1 = Forumcategory
	 * Type 2 = Thread
	 *
	 * param $type - check above
	 * param $id - id accociated with the type from above, ex, if type = 1 then $id is the current choosen category
	 * 
	 * returns - Array with current breadcrumb (Key Val pairs, key = crumb, value = link)
	 */
	 protected function __makeForumCrumbsArray($type, $id) {
	
		$this->loadModel('ForumCategory');
		$this->loadModel('Forum');
		$this->loadModel('Thread');
		
		$crumbs = array();
		
		switch($type) {
			case 0:
				$forumGroup = $this->Forum->findById($id);
				$crumbs['ForumGroup'] = array($forumGroup['Forum']['id'] => $forumGroup['Forum']['name']);
			break;
			case 1:
				$forumCategories = $this->ForumCategory->find('all');
				$forumCategory = $this->ForumCategory->findById($id);
				
				$forumGroup = $this->Forum->findById($forumCategory['ForumCategory']['forum_id']);
				$crumbs['ForumGroup'] = array($forumGroup['Forum']['id'] => $forumGroup['Forum']['name']);
				
				$crumbs = array_merge($crumbs, $this->__getCrumbCategories($forumCategories, $id));
			break;
			case 2:
				$thread = $this->Thread->findById($id);
				$forumCategories = $this->ForumCategory->find('all');
				$forumCategory = $this->ForumCategory->findById($thread['Thread']['forum_category_id']);
				
				$forumGroup = $this->Forum->findById($forumCategory['ForumCategory']['forum_id']);
				$crumbs['ForumGroup'] = array($forumGroup['Forum']['id'] => $forumGroup['Forum']['name']);
				
				$crumbs = array_merge($crumbs, $this->__getCrumbCategories($forumCategories, $thread['Thread']['forum_category_id']));
				$crumbs['ForumThread'] = array( $thread['Thread']['id'] => $thread['Thread']['topic'] );
			break;
		}
		
		return $crumbs;
	}
	/** 
	 * Recursive function for retreiving all categories (parent > child > child ..)
	 *
	 * return array with accociate array formatted as: ForumCategories => array (id => name, ..)
	 */
	protected function __getCrumbCategories($forumCategories, $stopId, $depth = 0) {
		$retArray = array();
		foreach($forumCategories as $f) {
			if ($f['ForumCategory']['id'] == $stopId) {
				$retArray[$f['ForumCategory']['id'] ] = $f['ForumCategory']['name'];
				// Does this category have a parent?
				if ($f['ForumCategory']['forum_category_id'] !== null) {
					$retArray = $retArray +$this->__getCrumbCategories($forumCategories, $f['ForumCategory']['forum_category_id'] , $depth+1);
				}
			}
		}
		if ($depth === 0) {
			// Reverse, higher index = higher level
			$retArray = array_reverse($retArray, true);
			$retArray = array('ForumCategories' => $retArray);
		}
		return $retArray;
	}

}
