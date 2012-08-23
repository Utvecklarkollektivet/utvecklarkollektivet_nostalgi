<h1><?php echo __('Register Keys'); ?></h1>
<table class="table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('User.username', 'Skapare'); ?></th>
			<th><?php echo $this->Paginator->sort('comment', 'Kommentar'); ?></th>
			<th><?php echo $this->Paginator->sort('key', 'Nyckel'); ?></th>
			<th><?php echo $this->Paginator->sort('Group.name', 'Grupp'); ?></th>
			<th><?php echo 'Åtgärder'; ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($registerKeys as $registerKey): ?>
			<tr>
				<td><?php echo $registerKey['RegisterKey']['id']; ?>&nbsp;</td>
				<td><?php echo $registerKey['User']['username']; ?>&nbsp;</td>
				<td class="max_table_width"><?php echo $registerKey['RegisterKey']['comment']; ?>&nbsp;</td>
				<td><?php echo $registerKey['RegisterKey']['key']; ?>&nbsp;</td>
				<td><?php echo $registerKey['Group']['name']; ?>&nbsp;</td>
				<td>
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
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>

<tfoot>
	<tr>
		<?php
		echo '<td>' . $this->Paginator->prev('< ' . __('Föregående'), array(), null, array('class' => 'prev disabled')) . '</td>';
		echo '<td colspan="4">' . $this->Paginator->numbers(array('separator' => '')) . '</td>';
		echo '<td>' . $this->Paginator->next(__('Nästa') . ' >', array(), null, array('class' => 'next disabled')) . '</td>';
		?>
	</tr>
</tfoot>
</table>
