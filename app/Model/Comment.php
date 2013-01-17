<?php

class Comment extends AppModel {
	public $belongsTo = array(
		'News' => array(
			'counterCache' => true,
		)
	);
	
	public $validate = array(
        'content' => array(
            'rule' => 'notEmpty'
        )
    );
}