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
		$this->set('posts', $this->Post->findAllByThreadId($id));
	   
		
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
}
