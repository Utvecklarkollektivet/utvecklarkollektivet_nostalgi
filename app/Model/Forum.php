<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Forum extends AppModel {
	
	public $name = 'Forum';
    public $hasMany = 'ForumCategory';

    public $validate = array(
            'name' => array(
                'required' => true,
                'allowEmpty' => false
            ),
            'description' => array(
                'required' => true,
                'allowEmpty' => false
            )
    );
}