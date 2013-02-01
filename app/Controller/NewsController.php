<?php

App::uses('AppController', 'Controller');

class NewsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
	
	public function index($url) {
		$this->loadModel('News');
		$this->set('item', $this->News->findByUrl($url));
		
	}
	
	
}