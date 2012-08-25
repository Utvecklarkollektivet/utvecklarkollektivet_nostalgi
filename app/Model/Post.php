<?php
class Post extends AppModel {

	public $belongsTo = array('Thread','User');
	// has one thread, has one user
}
