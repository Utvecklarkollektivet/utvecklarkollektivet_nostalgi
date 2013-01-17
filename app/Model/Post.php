<?php
class Post extends AppModel {

	public $belongsTo = array(
		'Thread' => array(
			'counterCache' => true,
			'counterScope' => array(
				'Post.hidden' => 0
			)
		)
		,'User'
	);
	// has one thread, has one user
}
