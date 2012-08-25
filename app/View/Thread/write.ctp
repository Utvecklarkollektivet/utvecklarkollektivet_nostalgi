<div class="forum_category">
	<h3>Skriv tråd</h3>
</div>
<?php
	echo $this->Form->create('Thread');
	echo $this->Form->input('topic');
	echo $this->Form->input('content', array('rows' => '8', 'class' => 'text-area-fix'));
	echo $this->Form->hidden('forum_category_id', array('value' => $forumCategoryId));
?>
<?php 
	$options = array(
	    'label' => 'Spara Tråd',
	    'class' => 'btn btn-primary'
	);
	echo $this->Form->end($options); 
?>
