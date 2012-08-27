<?php
/**
 * @author Utvecklarkollektivet
 * Class for Threads
 */
class Thread extends AppModel {

    public $name = 'Thread';
    public $hasMany = array(
		'Post' => array(
			'conditions' => array(
				'Post.hidden' => 1
			)
		)
	);
    public $belongsTo = array(
		'User', 
		'ForumCategory' => array(
			'counterCache' => true,
			'counterScope' => array(
				'Thread.hidden' => 0
			)
		)
	);

    /*
    Blir något fel här som jag inte har tid att kika på nu
    public $validate = array(
            'topic' => array(
                'required' => true,
                'allowEmpty' => false
            ),
            'content' => array(
                'required' => true,
                'allowEmpty' => false
            )
    );*/


}