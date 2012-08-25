<?php
/**
 * @author Utvecklarkollektivet
 *
 * Thread Controller.
 */
class ThreadController extends AppController {

	/**
	 * 
	 */
	public $uses = array('Thread','Post');
	
	/**
	 *
	 */
	public $helpers = array('Html');
	
	
	/**
	 *	This should not allow all in the future..
	 *
	 */
	public function beforeFilter() {
		$this->Auth->allow('*');
	}
	/**
	* Shows all threads
	*/
	public function index() {
		$this->set('threads', $this->Thread->find('all'));
	}
	/**
	 * Single Thread
	 */
	public function view($id = null) {
		$this->Thread->id = $id;
		// We don't want to join everything since we get the posts alone
		$this->Thread->recursive = 1; 
		$this->set('thread', $this->Thread->read());
		$this->set('posts', $this->Post->find('all', array(
			'conditions' => array(
				'Post.thread_id' => $id,
				'Post.hidden' => 0
			)
		)));
	   
		
	}
	
	/**
	 * New post
	 */
	public function write($forumCategoryId = NULL) {
		if ($this->request->is('post')) {
			$this->Thread->set('user_id', $this->Auth->user('id'));
			if ($this->Thread->save($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to add your post.');
			}
		} else {
			$this->set('forumCategoryId', $forumCategoryId);
		}
	}
	
	/**
	 * Edit a thread
	 *
	 */
	public function edit($id = null) {
		$this->Thread->id = $id;
		if (!$this->Thread->exists()) {
			throw new NotFoundException(__('Invalid thread'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// Important TODO:
			// If hidden, locked, forum_category_id is changed it have to be checked here in backend
			// that the user has access to hide, lock or move the thread
			if ($this->Thread->save($this->request->data)) {
				$this->Session->setFlash(__('The thread has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thread could not be saved. Please, try again.'));
			}
		} else {
			$this->loadModel('ForumCategory');
			
			$this->Thread->recursive = 0;
			$this->request->data = $this->Thread->read(
				array(
					'Thread.topic', 
					'Thread.content', 
					'Thread.locked',
					'Thread.forum_category_id'
				), 
				$id
			);
			
			$categories = $this->ForumCategory->find('list');
			
			$this->set('categories', $categories);
			$this->set('selectedForumCategory', $this->Thread->data['Thread']['forum_category_id']);
		}
	}
	/**
	 * Deleting thread just updates the hidden field to 1
	 *
	 */
	public function delete($id = null) {
		
		$this->Thread->id = $id;
		if (!$this->Thread->exists()) {
			throw new NotFoundException(__('Invalid forum thread'));
		}
		$this->Thread->read(null, $id);
		$this->Thread->set('hidden', 1);
		if ($this->Thread->save()) {
			$this->Session->setFlash(__('Forum thread deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Forum thread was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
