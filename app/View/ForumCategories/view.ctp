<div class="forum_category">
	<?php echo '<h3>' . $forumCategories['ForumCategory']['name'] . '</h3>'; ?>
	<div class="forum_category_logo"></div>
</div>

<?php foreach($forumCategories['ChildForumCategories'] as $c): ?>
	<div class="row">
		<div class="forum_sub_category">
			<div class="span0_5">
				<span class="icon-th forum_sub_category_icon"></span>
			</div>
			<div class="span5">
				<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?>
				<p class="small">Här finns kategorins beskrivning</p>
			</div>
			<div class="span2 forum_sub_category_field forum_sub_category_field_right">
				<p class="bold">X Poster</p>
				<p class="small">X Trådar</p>
			</div>
			<div class="span3 forum_sub_category_field">
				<p>Senaste post av <a href="#">ChristofferRydberg</a></p>
				<p>I <a href="#">Utvecklarkollektivet</a></p>
			</div>
			<div class="span0_5">
			<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/edit')): ?>
				<?php 
					echo $this->Html->link('Edit', array('controller' => 'ForumCategories', 'action' => 'edit', $c['id']), array('class' => 'icon-edit hiddentext')); 
				?>
			<?php endif; ?>
			<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/delete')): ?>
				<?php echo $this->Html->link('Delete', array('controller' => 'ForumCategories', 'action' => 'delete', $c['id']), array('class' => 'icon-remove hiddentext')); ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<hr />
<?php endforeach; ?>

<?php echo $this->Html->link('Skapa ny tråd', array('controller' => 'thread', 'action' => 'write', $forumCategories['ForumCategory']['id']),array('class' => 'btn')); ?>

<?php if (count($forumCategories['Thread']) > 0): ?>
	<div class="forum_thread_header">
		<h3>Trådar</h3>
	</div>
	<?php foreach($forumCategories['Thread'] as $t): ?>
		<div class="row">
			<div class="forum_thread">
				<div class="span0_5">
					<span class="icon-th forum_thread_icon"></span>
				</div>
				<div class="span7 forum_thread_name">
					<?php echo $this->Html->link($t['topic'], array('controller' => 'thread', 'action' => 'view', $t['id'])); ?>
				</div>
				<div class="span3 forum_thread_field">
					<p class="bold">X Posts</p>
					<p class="small">Skapat av <a href="#">ChristofferRydberg</a></p>
				</div>
				<div class="span0_5">
					<?php echo $this->Html->link('Edit', array('controller' => 'thread', 'action' => 'edit', $t['id']), array('class' => 'icon-edit hiddentext')); ?>
					<?php echo $this->Html->link('Edit', array('controller' => 'thread', 'action' => 'delete', $t['id']), array('class' => 'icon-remove hiddentext')); ?>
				</div>
			</div>
		</div>
		<hr />
	<?php endforeach; ?>
<?php endif; ?>
<div class="forum_button">
	<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/add')): ?>
		<?php echo $this->Html->link('Skapa kategori', array('controller' => 'ForumCategories', 'action' => 'add'),array('class' => 'btn')); ?>
	<?php endif; ?>
</div>