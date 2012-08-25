<?php
/**
 * @author Utvecklarkollektivet
 *
 * Post Controller.
 */
class PostsController extends AppController {

	/**
	 *	This should not allow all in the future..
	 *
	 */
	public function beforeFilter() {
		$this->Auth->allow('*');
	}
	
	
	public function add($threadID = NULL) {
		if ($this->request->is('post')) {
			$this->Post->set('thread_id', $threadID);
			$this->Post->set('user_id', $this->Auth->user('id'));
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Unable to add your post.');
			}
		}
	}
	
	/**
	 * Edit a post
	 *
	 */
	public function edit($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid thread'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// Important TODO:
			// Check somehow if this user is owner or has permissions...
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The Post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.'));
			}
		} else {
			
			$this->Post->recursive = 0;
			$this->request->data = $this->Post->read(
				array(
					'Post.content', 
				), 
				$id
			);
			
		}
	}
	/**
	 * Deleting post just updates the hidden field to 1
	 *
	 */
	public function delete($id = null) {
		
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid forum Post'));
		}
		$this->Post->read(null, $id);
		$this->Post->set('hidden', 1);
		if ($this->Post->save()) {
			$this->Session->setFlash(__('Forum Post deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Forum Post was not deleted'));
		$this->redirect(array('action' => 'index'));
	}



}
?>
