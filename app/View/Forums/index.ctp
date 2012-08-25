<?php foreach($forums as $f): ?>
	<div class="forum_category">
    	<?php echo $this->Html->link($f['Forum']['name'], array('controller' => 'forums', 'action' => 'f', $f['Forum']['id'])); ?>
    	<div class="forum_category_logo"></div>
	</div>
	
		<?php foreach($f['ForumCategory'] as $c): ?>
			<div class="forum_sub_category">
				<span class="icon-th"></span>
				<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?>
				
				<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/edit')): ?>
					<?php echo $this->Html->link('Edit', array('controller' => 'ForumCategories', 'action' => 'edit', $c['id'])); ?>
				<?php endif; ?>
				<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/delete')): ?>
					<?php echo $this->Html->link('Delete', array('controller' => 'ForumCategories', 'action' => 'delete', $c['id'])); ?>
				<?php endif; ?>
				
			</div>
		<?php endforeach; ?>
	
<?php endforeach; ?>

<?php if ($acl->check(array('User' => $user), 'controllers/Forums/add')): ?>
	<?php echo $this->Html->link('Skapa forumgrupp', array('controller' => 'Forums', 'action' => 'add')); ?>
<?php endif; ?>

<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/add')): ?>
	<?php echo $this->Html->link('Skapa kategori', array('controller' => 'ForumCategories', 'action' => 'add')); ?>
<?php endif; ?>