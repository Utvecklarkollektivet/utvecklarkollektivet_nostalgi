<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Forum extends AppModel {
	
	public $name = 'Forum';
    //public $hasMany = 'ForumCategory'; /*array(
    public $hasMany = array(
		'ForumCategory' => array(
			'conditions' => array('ForumCategory.forum_category_id' => null)
		)
		
	);

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