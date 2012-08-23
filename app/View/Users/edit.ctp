<h1>Editera användare</h1>
<div class="row">
	<div class="span6">
		<?php echo $this->Form->create('User'); ?>
			<?php
				echo $this->Form->input(
					'username', 
					array(
						'label' => false, 
						'class' => 'input_field'
					));

				echo $this->Form->input(
					'password',
					 array(
						'label' => false, 
						'placeholder' => 'Nytt lösenord...',
						'class' => 'input_field'
					));

				echo $this->Form->input(
					'group_id', 
					array(
						'label' => false, 
						'selected' => $selectedGroup
					));
			?>
		<?php 
		$options = array(
		    'label' => 'Spara',
		    'class' => 'btn'
		);
		echo $this->Form->end($options); ?>
	</div>
</div>