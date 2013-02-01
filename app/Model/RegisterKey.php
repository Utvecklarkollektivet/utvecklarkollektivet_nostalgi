<?php
App::uses('AppModel', 'Model');
/**
 * RegisterKey Model
 *
 * @property User $User
 * @property Group $Group
 */
class RegisterKey extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'key' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'group_id' => array(
			'nonempty' => array(
				'rule' => array('notempty')
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'min' => array(
				'rule' => array('comparison', '>', 0)
			),
		),
	);

	public $belongsTo = array('Group', 'User');

	/**
	 * Check if the key is valid.
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function isValid($key) {
		$count = $this->find(
			'count',
			array('conditions' => 
				array('RegisterKey.key' => $key)
			)
		);
		return ($count == 1);
	}

	/**
	 * Use the key, this will delete the key from the database.
	 *
	 * @param string $key
	 */
	public function useKey($key) {
		$this->deleteAll(array('RegisterKey.key' => $key));
	}

	/**
	 * Get group_id from key
	 *
	 * @param string $key
	 * @return integer
	 */
	public function getGroup($key) {
		$result = $this->find(
			'first', 
			array(
				'fields' => 'RegisterKey.group_id',
				'conditions' => array('RegisterKey.key' => $key)
			)
		);
		return $result['RegisterKey']['group_id'];
	}


	/**
	 * Generate a key
	 *
	 * @return string
	 */
	public function generateKey() {
		$key = md5( time() . rand() . "#4%");
		$key = strtoupper(substr($key, 0, 20));
		$key[4] = $key[9] = $key[14] = '-';
		return $key;
	}
}
