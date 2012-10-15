<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {

	/**
	 * The name of the model
	 *
	 * @var string
	 */
	public $name = 'User';

	/**
	 * User belongs to a Group
	 *
	 * @var array
	 */
	public $belongsTo = array('Group');
	
	/**
	 * User hasMany Threads and Posts
	 * @var array
	 */
	public $hasMany = array('Thread', 'Post');

	/**
	 * Acts as requester in Acl
	 *
	 * @var array
	 */
	public $actsAs = array('Acl' => array('type' => 'requester'));

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Du måste ange ett användarnamn...'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Användarnamnet är upptaget...'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Du måste ange ett lösenord...'
			),
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('email'),
				'message' => 'Fel email-format...')
		)

	);


	/**
	 * This function is called before the model is saved to database.
	 *
	 * @return boolean
	 */
	public function beforeSave($options = array()) {
		$this->data['User']['password'] =
			AuthComponent::password($this->data['User']['password']);
			return true;
	}

	/**
	 * Return the parent Acl-node.
	 */
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}

		if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}

		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}
}
