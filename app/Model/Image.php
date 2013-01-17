<?php

class Image extends AppModel {
	
	public $belongsTo = array(
		'News' => array(
			'counterCache' => true,
		)
	);
	// has one thread, has one user
}