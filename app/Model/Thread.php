<?php
/**
 * @author Utvecklarkollektivet
 * Class for Threads
 */
class Thread extends AppModel {

	public $name = 'Thread';
	public $hasMany = 'post';
	public $belongsTo = 'user';

	public $validate = array(
			'topic' => array(
				'required' => true,
				'allowEmpty' => false
			),
			'content' => array(
				'required' => true,
				'allowEmpty' => false
			)
	);


}
