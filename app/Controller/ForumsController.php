<?php
App::uses('AppController', 'Controller');

/**
 * Groups Controller
 *
 * @property Group $Group
 */
class ForumsController extends AppController {

	public $helpers = array('Html', 'Form');
	/**
	 * Temporary to allow all users all functions.
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	/**
	 * Lists all forums
	 *
	*/
	public function index() {
		
		$this->set('forums', $this->Forum->find('all', array(
			'conditions' => array(
				'Forum.hidden' => 0
			)
		)));
		
	}
	
	/**
	 * Shows only one forum
	 *
	 */
	public function category() {
		$this->loadModel('Thread');
		$this->set('threads', $this->Thread->findAllByForumsId($this->params['pass'][0], array(),  array('Thread.created' => 'desc')));
	}
	/**
	 * Write a thread, not currently in use (ThreadController handles this)
	 *
	 */
	public function write() {
		$this->loadModel('Thread');
		if ($this->request->is('post')) {
            $this->Thread->set('user_id', $this->Auth->user('id'));
            $this->Thread->set('forums_id', $this->params['pass'][0]);
            if ($this->Thread->save($this->request->data)) {
                $this->Session->setFlash('Din tråd har sparats.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Kunde inte spara tråden.');
            }
        }
	}

	public function view($id = null) {
		$this->loadModel('Thread');
		$this->loadModel('Post');

		$this->Thread->id = $id;
        // We don't want to join everything since we get the posts alone
        $this->Thread->recursive = 1; 
        $this->set('thread', $this->Thread->read());
        $this->set('posts', $this->Post->findAllByThreadId($id));
	}

    
    /**
	 * Add a new forum
	 *
	 */
    public function add($threadID = NULL) {
        if ($this->request->is('post')) {
            if ($this->Forum->save($this->request->data)) {
                $this->Session->setFlash('Your forum has been saved.');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Unable to add your forum.');
            }
        }
    }

}
