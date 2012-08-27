<?php
App::uses('AppController', 'Controller');


class ForumCategoriesController extends AppController {

	public $paginate = array(
		'limit' => 25,
		'order' => 'Thread.created'
	);
	
	/*
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	*/
	
	public function index() {
		$this->set('forumCategories', $this->ForumCategory->find('all'));
		
	}
	
	public function view($id = NULL) {
		$this->loadModel('Thread');
		$this->ForumCategory->recursive = 2;
		$this->set('forumCategories', $this->ForumCategory->findById($id));
		$this->set('breadcrumbs', $this->__makeForumCrumbsArray(1, $id));
		
		$this->set('threads', $this->paginate('Thread', array(
			'Thread.hidden' => 0,
			'Thread.forum_category_id' => $id
		)));
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
	/**
	 * Edit a forum category
	 *
	 */
	public function edit($id = null) {
		$this->ForumCategory->id = $id;
		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
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
				$this->Session->setFlash(__('The forum category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum category could not be saved. Please, try again.'));
			}
		} else {
			$this->loadModel('Forum');
			
			$this->ForumCategory->recursive = 0;
			$this->request->data = $this->ForumCategory->read(
				array(
					'ForumCategory.forum_id', 
					'ForumCategory.forum_category_id', 
					'ForumCategory.name',
					'ForumCategory.description',
					'ForumCategory.hidden',
				), 
				$id
			);
			
			$forums = $this->Forum->find('list');
			$categories = $this->ForumCategory->find('list');
			
			$this->set('forums', $forums);
			$this->set('categories', $categories);
			$this->set('selectedForum', $this->ForumCategory->data['ForumCategory']['forum_id']);
			$this->set('selectedForumCategory', $this->ForumCategory->data['ForumCategory']['forum_category_id']);
		}
	}
	
	public function delete($id = null) {
		
		$this->ForumCategory->id = $id;
		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		if ($this->ForumCategory->delete($id, true)) {
			$this->Session->setFlash(__('Forum category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Forum category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}