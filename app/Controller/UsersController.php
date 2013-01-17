<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	/**
	 * Default pagination settings
	 */
	public $paginate = array(
		'fields' => array(
			'User.id',
			'User.display_name',
			'User.username', 
			'User.created', 
			'Group.name', 
			'Group.id'
		),
		'limit' => 25,
		'User.username' => 'desc'
	);

	/**
	 * This function is called before any thing else
	 *
	 * TIP: Uncomment $this->Auth->allow('add'); and go to /users/add to create a first user
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
		$this->Auth->allow('add');
		$this->Auth->allow('logout');
	}

	/**
	 * index method
	 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate('User'));
	}

	/**
	 * login method
	 */
	public function login() {
		$this->layout = 'login';

		if ($this->Auth->User('id') != null) {
			$this->redirect('/');
		}

		if (!$this->request->is('post')) {
			return;
		}

		if ($this->Auth->login()) {
			$this->redirect($this->Auth->redirect());
		}
		else {
			$this->User->invalidate('User.password', 'Fel användarnamn eller lösenord...'); 
		}

		$this->set('validationErrors', $this->User->validationErrors);
	}

	/**
	 * Logout method
	 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$this->layout = 'login';
		
		if ($this->Auth->User('id') != null) {
			$this->redirect('/');
		}

		if (!$this->request->is('post')) {
			return;
		}

		$this->loadModel('RegisterKey');
		$key = $this->data['User']['activation'];
		
		if (!$this->RegisterKey->isValid($key)) {
			$this->User->invalidate(
				'User.activation',
				'Aktivationskoden är inte giltig...'
			);
		} else {
			$this->User->create();
			$this->request->data['User']['group_id'] = 
				$this->RegisterKey->getGroup($key);

			if ($this->User->save($this->request->data)) {
				$this->RegisterKey->useKey($key);
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set('validationErrors', $this->User->validationErrors);
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->User->recursive = 0;
			$this->request->data = $this->User->read(
				array('User.username', 'Group.id', 'Group.name', 'User.email'), 
				$id
			);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
		$this->set('selectedGroup', $this->User->data['Group']['id']);
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function mail($id = null) {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate('User'));
		$this->loadModel('Group');
		$this->set('groups', $this->Group->find('list'));
		if ($this->request->is('post') || $this->request->is('put')) {
			$email = new CakeEmail();
			if (!empty($this->data['User']['selected'])) {
				foreach($this->data['User']['selected'] as $user_specified) {
					$mailto = $this->User->findAllByUsername($user_specified);
					$email->to($mailto[0]['User']['email']);
					$email->from(array('no-reply@utveklarkollektivet.se' => 'Utvecklarkollektivet.se'));
					$email->subject($this->data['User']['head']);
					$email->send($this->data['User']['Text']);

				}


			}
			
			if(!empty($this->data['User']['group_id'])) {
				$mail_to_user = $this->User->findAllByGroupId($this->data['User']['group_id']);

				foreach($mail_to_user as $user_mail) {
					$email->to($user_mail['User']['email']);
					$email->from(array('no-reply@utvecklarkollektivet.se' => 'Utvecklarkollektivet.se'));
					$email->subject($this->data['User']['head']);
					$email->send($this->data['User']['Text']);
				}
			}

		}
	}
}
