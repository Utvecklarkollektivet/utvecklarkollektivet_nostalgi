<h1>Add Post</h1>
<?php
	echo $this->Form->create('Thread');
	echo $this->Form->input('topic');
	echo $this->Form->input('content', array('rows' => '3'));
	echo $this->Form->end('Save Thread');
?>
