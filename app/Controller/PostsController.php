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



}
?>
