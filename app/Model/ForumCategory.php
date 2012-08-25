<?php
/**
 * @author Utvecklarkollektivet
 * Class for forum_categories
 */
class ForumCategory extends AppModel {

	public $useTable = 'forum_categories';
	
    public $hasMany = array(
		'Thread' => array(
			'conditions' => array(
				'Thread.hidden' => 0
			)
		), 
		'ChildForumCategories' => array(
			'className' => 'ForumCategory',
			'foreignKey' => 'forum_category_id'
		)
	);
    public $belongsTo = array(
		'Forum', 
		'ParentForumCategory' => array(
			'className' => 'ForumCategory',
			'foreignKey' => 'forum_category_id'
		)
	);


}