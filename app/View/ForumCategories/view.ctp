<div class="forum_category">
	<?php echo '<h3>' . $forumCategories['ForumCategory']['name'] . '</h3>'; ?>
	<div class="forum_category_logo"></div>
</div>

<?php foreach($forumCategories['ChildForumCategories'] as $c): ?>
	<div class="forum_sub_category">
		<span class="icon-th"></span>
		<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?>
		
		<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/edit')): ?>
			<?php echo $this->Html->link('Edit', array('controller' => 'ForumCategories', 'action' => 'edit', $c['id'])); ?>
		<?php endif; ?>
		<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/delete')): ?>
			<?php echo $this->Html->link('Delete', array('controller' => 'ForumCategories', 'action' => 'delete', $c['id'])); ?>
		<?php endif; ?>
		<br />
	</div>

<?php endforeach; ?>

<?php echo $this->Html->link('Skapa ny tråd', array('controller' => 'thread', 'action' => 'write', $forumCategories['ForumCategory']['id']),array('class' => 'btn')); ?>

<?php if (count($forumCategories['Thread']) > 0): ?>
	<div class="forum_thread_header">
		<h3>Trådar</h3>
	</div>
	<?php foreach($forumCategories['Thread'] as $t): ?>
		<div class="forum_thread">
			<?php echo $this->Html->link($t['topic'], array('controller' => 'thread', 'action' => 'view', $t['id'])); ?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>

<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/add')): ?>
	<?php echo $this->Html->link('Skapa kategori', array('controller' => 'ForumCategories', 'action' => 'add')); ?>
<?php endif; ?>