<h1 class="grid_12">Grupper</h1>
<div class="clear"></div>

<div style="background-color: #EEE; padding: 2px 0px; margin-bottom: 2px;">
	<div class="grid_1"><?php echo $this->Paginator->sort('id'); ?></div>
	<div class="grid_5"><?php echo $this->Paginator->sort('name', 'Namn'); ?></div>
	<div class="grid_4"><?php echo $this->Paginator->sort('created', 'Skapad'); ?></div>
	<div class="grid_2">Åtgärder</div>
	<div class="clear"></div>
</div>

<?php
foreach ($groups as $group): ?>
	<div class="grid_1"><?php echo $group['Group']['id']; ?>&nbsp;</div>
	<div class="grid_5">
		<?php echo $this->Html->link($group['Group']['name'], array('action' => 'view', $group['Group']['id'])); ?>
	</div>
	<div class="grid_4"><?php echo $group['Group']['created']; ?>&nbsp;</div>
	<div class="grid_2">
		<?php echo $this->Html->link('Editera', array('action' => 'edit', $group['Group']['id'])); ?>
		<?php echo $this->Form->postLink(
			'Radera',
			array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])
		); ?>
	</div>
<?php endforeach; ?>

<div class="grid_12" style="text-align: center; margin-top: 10px;">
<?php
	echo $this->Paginator->prev('< ' . __('Föregående'), array(), null, array('class' => 'prev disabled')) . ' ';
	echo $this->Paginator->numbers(array('separator' => '')) . ' ';
	echo $this->Paginator->next(__('Nästa') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
