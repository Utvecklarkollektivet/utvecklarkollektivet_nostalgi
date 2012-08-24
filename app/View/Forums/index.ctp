<?php foreach($forums as $f): ?>
	<div class="forum_category">
    	<?php echo $this->Html->link($f['Forum']['name'], array('controller' => 'forums', 'action' => 'f', $f['Forum']['id'])); ?>
    	<div class="forum_category_logo"></div>
	</div>
	
	<?php foreach($f['ForumCategory'] as $c): ?>
		<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?><br />
	<?php endforeach; ?>
	
<?php endforeach; ?>