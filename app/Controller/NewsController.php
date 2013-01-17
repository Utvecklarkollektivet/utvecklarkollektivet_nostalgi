<?php

App::uses('AppController', 'Controller');

class NewsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
	
	public function index($url) {
		$this->loadModel('News');
		$this->set('item', $this->News->findByUrl($url));
		
	}
	
	public function comment() {
		if ($this->request->is('post')) {
			$this->loadModel('Comment');
            $this->Comment->create();
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
	}
	
}