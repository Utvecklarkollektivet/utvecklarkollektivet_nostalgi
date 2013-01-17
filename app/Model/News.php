<?php

class News extends AppModel {
	public $name = 'news';
	
	public $hasMany = array(
		'images' => array(
		),
		'comments' => array(
			'order' => 'created DESC'
		)
	);
}