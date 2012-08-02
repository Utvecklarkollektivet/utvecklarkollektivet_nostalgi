<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {

	/**
	 *	The name of the model
	 */
	public $name = 'Group';

	/**
	 * Acts as settings
	 *
	 * @var array $actsAs
	 */
	public $actsAs = array('Acl' => array('type' => 'requester'));

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Gruppen måste ha ett namn...'
			),
			'chars' => array(
				'rule' => '/^([1-9 _a-zåäö]+)$/i',
				'message' => 'Gruppens namn innehåller felaktiga tecken...'
			)
		)	
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * This is the top node in Acl node-three
	 */
	public function parentNode() {
		return null;
	}

	/**
	 * Delete the acl_permission-rows.
	 */
	public function delete() {
		ClassRegistry::init('AclManager')->deleteGroupPermissions($this->id);
		return parent::delete();
	}

}
