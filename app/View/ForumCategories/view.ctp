<div class="forum_category">
	<?php echo '<h3>' . $forumCategories['ForumCategory']['name'] . '</h3>'; ?>
	<div class="forum_category_logo"></div>
</div>

<?php foreach($forumCategories['ChildForumCategories'] as $c): ?>
	<div class="forum_sub_category">
		<span class="icon-th"></span>
		<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?><br />
	</div>

<?php endforeach; ?>

<?php echo $this->Html->link('Skapa ny tråd', array('controller' => 'thread', 'action' => 'write', $forumCategories['ForumCategory']['id']),array('class' => 'btn')); ?>

<div class="forum_thread_header">
	<h3>Trådar</h3>
</div>
<?php foreach($forumCategories['Thread'] as $t): ?>
	<div class="forum_thread">
		<?php echo $this->Html->link($t['topic'], array('controller' => 'thread', 'action' => 'view', $t['id'])); ?>
	</div>
<?php endforeach; ?>