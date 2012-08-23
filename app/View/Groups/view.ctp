<h1>Grupp: <?php echo $group['Group']['name']; ?></h1>
<p class="small group_info">
	(id: <?php echo $group['Group']['id']; ?> - 
 	Skapad: <?php echo $group['Group']['created']; ?> - 
 	<?php echo $this->Html->link('Editera', array('controller' => 'groups', 'action' => 'edit', $group['Group']['id'])); ?>)
</p>
<div class="row">
	<div class="span12">
		<h3>Medlemmar</h3>
		<?php
			foreach ($users as $user): ?>
			<?php $user = $user['User']; ?>
				<?php echo $this->Html->link($user['username'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
		<?php endforeach; ?>
	</div>
</div>
