<h1 class="grid_12">Användare</h1>
<div class="clear"></div>

<div style="background-color: #EEE; padding: 2px 0px; margin-bottom: 3px;">
	<div class="grid_1"><?php echo $this->Paginator->sort('id'); ?></div>
	<div class="grid_3"><?php echo $this->Paginator->sort('username', 'Användarnamn'); ?></div>
	<div class="grid_3"><?php echo $this->Paginator->sort('group_id', 'Grupp'); ?></div>
	<div class="grid_3"><?php echo $this->Paginator->sort('created', 'Skapad'); ?></div>
	<div class="grid_2">Åtgärder</div>
	<div class="clear"></div>
</div>

<?php
foreach ($users as $user): ?>
	<div class="grid_1"><?php echo $user['User']['id']; ?>&nbsp;</div>
	<div class="grid_3">
		<?php echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id'])); ?>
	</div>
	<div class="grid_3">
		<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
	</div>
	<div class="grid_3"><?php echo h($user['User']['created']); ?>&nbsp;</div>
	<div class="grid_2">
		<?php echo $this->Html->link('Editera', array('action' => 'edit', $user['User']['id'])); ?>
		<?php echo $this->Form->postLink('Radera', array('action' => 'delete', $user['User']['id']), null, __('Säker på att du vill radera # %s?', $user['User']['id'])); ?>
	</div>
	<div class="clear"></div>
<?php endforeach; ?>

<div class="grid_12" style="text-align: center; margin-top: 10px;">
<?php
	echo $this->Paginator->prev('< Föregående', array(), null, array('class' => 'prev disabled')) . ' ';
	echo $this->Paginator->numbers(array('separator' => ' ')) . ' ';
	echo $this->Paginator->next('Nästa >', array(), null, array('class' => 'next disabled'));
?>
</div>
