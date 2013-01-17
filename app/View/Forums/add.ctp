<h1>Skapa nytt forum/huvudkategori</h1>
<?php
	echo $this->Form->create('Forum');
	echo $this->Form->input('name');
	echo $this->Form->input('description', array('rows' => '3'));
?>
<?php 
	$options = array(
	    'label' => 'Spara',
	    'class' => 'btn btn-primary'
	);
	echo $this->Form->end($options); 
?>