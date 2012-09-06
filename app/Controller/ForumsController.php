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
	 * Lists all forums
	 *
	*/
	public function index() {

        $this->loadModel('Thread');
        $this->loadModel('Post');
        $this->loadModel('User');
		
        $forums =  $this->Forum->find('all');
        $data = array();

        foreach($forums as $forum) {
            foreach($forum as $key => $categories) {
                if($key == 'ForumCategory') {
                    foreach($categories as $category) {
                        $thread = $this->Thread->query('SELECT id, topic FROM threads WHERE forum_category_id = ' . $category['id'] . ' ORDER BY modified DESC LIMIT 1');
                        if(!empty($thread)) {
                            $post = $this->Post->query('SELECT user_id FROM posts WHERE thread_id = ' . $thread[0]['threads']['id'] . ' ORDER BY created DESC LIMIT 1');
                            if(!empty($post)) {
                                $user = $this->User->query('SELECT id, username FROM users WHERE id = '. $post[0]['posts']['user_id'] . ' LIMIT 1');
                                $data[] = array('id' => $category['id'], 'data' => array('latest_thread' => array('id' => $thread[0]['threads']['id'], 'topic' => $thread[0]['threads']['topic']), 'latest_poster' => array('id' => $user[0]['users']['id'], 'username' => $user[0]['users']['username'])));
                            }
                        }
                    }
                }
            }
        }

        $this->set('forums_data', $data);

		$this->set('forums', $this->Forum->find('all', array(
			'conditions' => array(
				'Forum.hidden' => 0
			)
		)));
		
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
		$this->set('forums', $this->Forum->findById($id));
		$this->set('breadcrumbs', $this->__makeForumCrumbsArray(0, $id));
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
