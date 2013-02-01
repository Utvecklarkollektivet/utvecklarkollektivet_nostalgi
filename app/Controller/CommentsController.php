<?php

App::uses('AppController', 'Controller');

class CommentsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
	
	public function add($newsID = null) {
		if ($this->request->is('post')) {
			$this->Comment->set('news_id', $newsID);
			$this->Comment->set('user_id', $this->Auth->user('id'));
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash('Din kommentar sparades.');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Kunde inte spara din kommentar!');
			}
		}
		else {
			$this->Session->setFlash('Du måste skriva en kommentar först!');
			$this->redirect($this->referer());
		}
	}
	
}