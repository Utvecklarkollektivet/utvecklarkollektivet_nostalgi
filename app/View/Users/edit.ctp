<div class="grid_4">
<h1>Editera användare</h1>
<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->input('username', array('label' => false));
        echo "\n";
		echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Nytt lösenord...'));
        echo "\n";
		echo $this->Form->input('group_id', array('label' => false, 'selected' => $selectedGroup));
	?>
<?php echo $this->Form->end('Spara'); ?>
</div>
