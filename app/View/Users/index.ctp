<h1>Användare</h1>
<div class="row">
	<div class="span11">
		<table class="table">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('display_name', 'Namn'); ?></th>
					<th><?php echo $this->Paginator->sort('username', 'Användarnamn'); ?></th>
					<th><?php echo $this->Paginator->sort('group_id', 'Grupp'); ?></th>
					<th><?php echo $this->Paginator->sort('created', 'Skapad'); ?></th>
					<th>Åtgärder</th>
				</tr>
		</thead>
		<tbody>
		<?php
		foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user['User']['id']; ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($user['User']['display_name'], array('action' => 'view', $user['User']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
				</td>
				<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link('Editera', array('action' => 'edit', $user['User']['id'])); ?>
					<?php echo $this->Form->postLink('Radera', array('action' => 'delete', $user['User']['id']), null, __('Säker på att du vill radera # %s?', $user['User']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
		<?php
			echo '<td>' . $this->Paginator->prev('< Föregående', array(), null, array('class' => 'prev disabled')) . '</td>';
			echo '<td colspan="3">' . $this->Paginator->numbers(array('separator' => ' ')) . '</td>';
			echo '<td>' . $this->Paginator->next('Nästa >', array(), null, array('class' => 'next disabled')) . '</td>';
		?>
		</tr>
		</tfoot>
		</table>
	</div>
</div>