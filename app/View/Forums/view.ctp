<?php 
$forumGroup = reset($breadcrumbs['ForumGroup']);
$forumGroupId = key($breadcrumbs['ForumGroup']);
$this->Html->addCrumb('Forums', '/forums');
$this->Html->addCrumb($forumGroup, '/forums/view/' . $forumGroupId);
?>
	<div class="forum_category">
    	<?php echo $this->Html->link($forums['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $forums['Forum']['url_name'])); ?>
    	<div class="forum_category_logo"></div>
	</div>
	
	<?php foreach($forums['ForumCategory'] as $c): ?>
		<div class="row">
			<div class="forum_sub_category">
				<div class="span0_5">
					<span class="icon-th forum_sub_category_icon"></span>
				</div>
				<div class="span5">
					<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['url_name'])); ?>
					<p class="small"><?php echo $c['description']; ?></p>
				</div>
				<div class="span2 forum_sub_category_field forum_sub_category_field_right">
					<p class="bold">X Poster</p>
					<p class="small"><?php echo $c['thread_count']; ?> Trådar</p>
				</div>
				<div class="span3 forum_sub_category_field">
					<p>Senaste post av <a href="#">ChristofferRydberg</a></p>
					<p>I <a href="#">Utvecklarkollektivet</a></p>
				</div>
				<div class="span0_5">
				<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/edit')): ?>
					<?php 
						echo $this->Html->link('Edit', array('controller' => 'ForumCategories', 'action' => 'edit', $c['url_name']), array('class' => 'icon-edit hiddentext')); 
					?>
				<?php endif; ?>
				<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/delete')): ?>
					<?php echo $this->Html->link('Delete', array('controller' => 'ForumCategories', 'action' => 'delete', $c['url_name']), array('class' => 'icon-remove hiddentext')); ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<hr />
	<?php endforeach; ?>
<div class="forum_button">
	<?php if ($acl->check(array('User' => $user), 'controllers/Forums/add')): ?>
		<?php echo $this->Html->link('Skapa forumgrupp', array('controller' => 'Forums', 'action' => 'add'), array('class' => 'btn')); ?>
	<?php endif; ?>

	<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/add')): ?>
		<?php echo $this->Html->link('Skapa kategori', array('controller' => 'ForumCategories', 'action' => 'add'), array('class' => 'btn')); ?>
	<?php endif; ?>
</div>