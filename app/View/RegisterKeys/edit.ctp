<h1>Editera Registreringsnyckel { <?php echo $this->data['RegisterKey']['key']; ?> }</h1>

<?php echo $this->Form->create('RegisterKey'); ?>
<div class="row">
	<div class="span6">
		<h3>Editera Nyckel</h3>
		<?php
			echo $this->Form->input('id'); // Är den här raden verkligen nödvändig???? (Fikuzen);
			echo $this->Form->input('user_id',array('class' => 'input_field'));
			echo $this->Form->input('comment');
			echo $this->Form->input('key', array('class' => 'input_field'));
			echo $this->Form->input('group_id');
		?>
		<?php 
			$options = array(
			    'label' => 'Spara Registreringsnyckel',
			    'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options);
		?>
	</div>
	<div class="span6">
		<h3>Hantera Registreringsnycklar</h3>
		<ul>
			<li><?php echo $this->Form->postLink(__('Delete Registerkey'), array('action' => 'delete', $this->Form->value('RegisterKey.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RegisterKey.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List other Registerkeys'), array('action' => 'index')); ?></li>
		</ul>
	</div>
</div>
