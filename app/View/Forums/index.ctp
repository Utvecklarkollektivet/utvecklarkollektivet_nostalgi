<?php foreach($forums as $f): ?>
	<div class="forum_category">
    	<?php echo $this->Html->link($f['Forum']['name'], array('controller' => 'forums', 'action' => 'f', $f['Forum']['id'])); ?>
    	<div class="forum_category_logo"></div>
	</div>
	
		<?php foreach($f['ForumCategory'] as $c): ?>
			<div class="forum_sub_category">
				<span class="icon-th"></span>
				<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?>
			</div>
		<?php endforeach; ?>
	
<?php endforeach; ?>