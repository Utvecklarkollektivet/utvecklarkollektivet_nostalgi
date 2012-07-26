<h1 class="grid_12">Editerar nyckel { <?php echo $this->data['RegisterKey']['key']; ?> }</h1>

<?php echo $this->Form->create('RegisterKey'); ?>
<div class="grid_6">
	<div class="registerKeys form">	
		<?php
			echo $this->Form->input('id'); // Är den här raden verkligen nödvändig???? (Fikuzen);
			echo $this->Form->input('user_id',array('class' => 'input_field'));
			echo $this->Form->input('comment');
			echo $this->Form->input('key', array('class' => 'input_field'));
			echo $this->Form->input('group_id');
		?>
		<?php echo $this->Form->end(__('Submit')); ?>
	</div>
	<div class="actions">
		<ul>
			<li><?php echo 'Do you want to ' . $this->Form->postLink(__('delete'), array('action' => 'delete', $this->Form->value('RegisterKey.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RegisterKey.id'))) . ' the key'; ?></li>
			<li><?php echo 'Go back and ' . $this->Html->link(__('list other registerkeys'), array('action' => 'index')); ?></li>
		</ul>
	</div>
</div>
