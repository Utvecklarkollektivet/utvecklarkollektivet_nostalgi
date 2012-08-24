<?php
App::uses('AppController', 'Controller');


class ForumCategoriesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
	public function index() {
		$this->set('forumCategories', $this->ForumCategory->find('all'));
	}
	
	public function view($id = NULL) {
		$this->set('forumCategories', $this->ForumCategory->findById($id));
		echo "###";
		print_r($this->ForumCategory->findById($id));
	}


}