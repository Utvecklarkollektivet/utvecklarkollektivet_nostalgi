<h1>Add new forum</h1>
<?php
	echo $this->Form->create('Forum');
	echo $this->Form->input('name');
	echo $this->Form->input('description', array('rows' => '3'));
	echo $this->Form->end('Save Forum');
?>
