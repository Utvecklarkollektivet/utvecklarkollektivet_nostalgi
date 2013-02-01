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
        $numberOfPosts = array();



        foreach($forums as $forum) {
            foreach($forum as $key => $categories) {
                if($key == 'ForumCategory') {
                    foreach($categories as $category) {
                        $this->Thread->recursive = 0;
                        $threads = $this->Thread->findAllByForumCategoryId($category['id']);

                        $latestPost = null;
                        $latestThread = null;
                        $postCount = 0;

                        foreach($threads as $thread) {
                            if(!empty($thread)) {

                                $postCount += $this->Post->find('count', array('conditions' => array('Post.thread_id' => $thread['Thread']['id'])));

                                $latest_post_id = $this->Post->field('id', array('created <' => date('Y-m-d H:i:s'), 'thread_id' => $thread['Thread']['id']), 'created DESC');
                                if($latest_post_id) {
                                    $current = $this->Post->findById($latest_post_id);
                                    
                                    foreach($current as $post) {
                                        if(!empty($post)) {
                                            if($latestPost == null) {
                                                $latestPost = $post;
                                                $latestThread = $thread['Thread'];
                                            }

                                            else {
                                                if($latestPost['created'] < $post['created']) {
                                                    $latestPost = $post;
                                                    $latestThread = $thread['Thread'];
                                                } 
                                            }
                                        }
                                    }
                                } 
                            }
                        }

                        if($latestPost != null && $latestThread != null) {
                            $user = $this->User->findById($latestPost['user_id']);
                            $data[] = array('id' => $category['id'], 'data' => array('latest_poster' => array('id' => $user['User']['id'], 'username' => $user['User']['username']), 'latest_thread' => array('url_name' => $latestThread['url_name'], 'topic' => $latestThread['topic'])));
                        }

                        $numberOfPosts[] = array('id' => $category['id'], 'posts' => $postCount);
                        
                    }
                }
            }
        }

        $this->set('forums_data', $data);
        $this->set('postcount', $numberOfPosts);
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

	public function view($url_name = null) {
		$forum = $this->Forum->findByUrlName($url_name);
		$id = $forum['Forum']['id'];
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
