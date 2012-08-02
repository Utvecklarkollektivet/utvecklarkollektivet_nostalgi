<?php
class Post extends AppModel {

	public $belongsTo = array('thread','user');
	// has one thread, has one user
}
