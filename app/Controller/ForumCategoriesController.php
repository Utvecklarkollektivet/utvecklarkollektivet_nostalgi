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
	
	public function add() {
        if ($this->request->is('post')) {
			// Check if the user wants to add an sub category or not
			if (!empty($this->request->data['ForumCategory']['forum_category_id'])) {
				// Use the forum_id from the parent id
				$cat = $this->ForumCategory->findById($this->request->data['ForumCategory']['forum_category_id']);
				#echo "A";
				if (!empty($cat)) {
					$this->request->data['ForumCategory']['forum_id'] = $cat['ForumCategory']['forum_id'];
					#echo "B" . $this->request->data['ForumCategory']['forum_id'];
				} else {
					#die("C");
					$this->Session->setFlash('Unable to add category, parent category not found!');
					$this->redirect($this->referer());
				}
			}
            if ($this->ForumCategory->save($this->request->data)) {
                $this->Session->setFlash('Your forumcategory has been saved.');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        } else {
			$this->loadModel('Forum');
			// Fetch all forums to a key value paired array for the select input
			$select_forums = array();
			$forums = $this->Forum->find('all', array('recursive' => -1));
			foreach ($forums as $f) {
				$select_forums[$f['Forum']['id']] = $f['Forum']['name'];
			}
			
			$select_categories = array();
			$categories = $this->ForumCategory->find('all', array('recursive' => -1));
			foreach ($categories as $c) {
				$select_categories[$c['ForumCategory']['id']] = $c['ForumCategory']['name'];
			}
			
			$this->set('select_forums', $select_forums);
			$this->set('select_categories', $select_categories);
		}
	}
	
	public function edit($id = NULL) {
	
	}
	
	public function delete($id = NULL) {
	
	}


}