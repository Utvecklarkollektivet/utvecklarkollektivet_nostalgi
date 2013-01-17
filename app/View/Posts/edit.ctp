<h1>Edit post</h1>
<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('content', array('label' => false, 'rows' => '8', 'class' => 'text-area-fix'));
?>
<?php 
	$options = array(
		'label' => 'Svara',
		'class' => 'btn'
	);
	echo $this->Form->end($options); 
?>