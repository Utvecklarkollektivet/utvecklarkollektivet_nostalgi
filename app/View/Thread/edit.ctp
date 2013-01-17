<div class="forum_category">
	<h3>Skriv tråd</h3>
</div>
<?php
	echo $this->Form->create('Thread');
	echo $this->Form->input('topic');
	echo $this->Form->input('content', array('rows' => '8', 'class' => 'text-area-fix'));
	echo $this->Form->input('locked');
	echo $this->Form->input('forum_category_id', array(
		'options' => $categories,
		'selected' => $selectedForumCategory,
		'empty' => 'Välj Kategori'
	)); 
?>
<?php 
	$options = array(
	    'label' => 'Spara Tråd',
	    'class' => 'btn btn-primary'
	);
	echo $this->Form->end($options); 
?>
