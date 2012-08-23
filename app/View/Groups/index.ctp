<h1>Grupper</h1>
<div class="row-fluid">
	<div class="span12">
		<table class="table">
			<thead>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name', 'Namn'); ?></th>
				<th><?php echo $this->Paginator->sort('created', 'Skapad'); ?></th>
				<th>Åtgärder</th>
			</thead>
			<tbody>
				<?php
				foreach ($groups as $group): ?>
					<tr>
						<td><?php echo $group['Group']['id']; ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($group['Group']['name'], array('action' => 'view', $group['Group']['id'])); ?>
						</td>
						<td><?php echo $group['Group']['created']; ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link('Editera', array('action' => 'edit', $group['Group']['id'])); ?>
							<?php echo $this->Form->postLink(
								'Radera',
								array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])
							); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<?php
						echo '<td>' . $this->Paginator->prev('< ' . __('Föregående'), array(), null, array('class' => 'prev disabled')) . '</td>';
						echo '<td colspan="2"' . $this->Paginator->numbers(array('separator' => '')) . '</td>';
						echo '<td>' . $this->Paginator->next(__('Nästa') . ' >', array(), null, array('class' => 'next disabled')) . '</td>';
					?>
				</tr>
			</tfoot>
		</table>
	</div>
</div>