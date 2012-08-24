<h1>Add Post</h1>
<?php
	echo $this->Form->create('Thread');
	echo $this->Form->input('topic');
	echo $this->Form->input('content', array('rows' => '3'));
	echo $this->Form->hidden('forum_category_id', array('value' => $forumCategoryId));
	echo $this->Form->end('Save Thread');
?>
