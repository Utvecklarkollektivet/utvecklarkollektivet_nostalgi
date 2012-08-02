<h1 class="grid_12"><?php echo __('Register Keys'); ?></h1>
<div class="clear"></div>
<div style="background-color: #EEE; padding: 2px 0px; margin-bottom: 3px;">
	<div class="grid_1"><?php echo $this->Paginator->sort('id'); ?></div>
	<div class="grid_2"><?php echo $this->Paginator->sort('User.username', 'Skapare'); ?></div>
	<div class="grid_2"><?php echo $this->Paginator->sort('comment', 'Kommentar'); ?></div>
	<div class="grid_3"><?php echo $this->Paginator->sort('key', 'Nyckel'); ?></div>
	<div class="grid_2"><?php echo $this->Paginator->sort('Group.name', 'Grupp'); ?></div>
	<div class="grid_2"><?php echo 'Åtgärder'; ?></div>
	<div class="clear"></div>
</div>

<?php
foreach ($registerKeys as $registerKey): ?>
	<div class="grid_1"><?php echo $registerKey['RegisterKey']['id']; ?>&nbsp;</div>
	<div class="grid_2"><?php echo $registerKey['User']['username']; ?>&nbsp;</div>
	<div class="grid_2"><?php echo $registerKey['RegisterKey']['comment']; ?>&nbsp;</div>
	<div class="grid_3"><?php echo $registerKey['RegisterKey']['key']; ?>&nbsp;</div>
	<div class="grid_2"><?php echo $registerKey['Group']['name']; ?>&nbsp;</div>
	<div class="grid_2">
		<?php echo $this->Html->link(__('Editera'), array('action' => 'edit', $registerKey['RegisterKey']['id'])); ?>
		<?php 
			echo $this->Form->postLink(
				'Radera', 
				array(
					'action' => 'delete', 
					$registerKey['RegisterKey']['id']
				),
				null,
				__('Är du säker på att du vill radera # %s?', $registerKey['RegisterKey']['id'])
			); 
		?>
	</div>
	<div class="clear"></div>
<?php endforeach; ?>

<div class="grid_12" style="text-align: center; margin-top: 10px;">
	<?php
	echo $this->Paginator->prev('< ' . __('Föregående'), array(), null, array('class' => 'prev disabled')) . ' ';
	echo $this->Paginator->numbers(array('separator' => '')) . ' ';
	echo $this->Paginator->next(__('Nästa') . ' >', array(), null, array('class' => 'next disabled'));
	?>
</div>
