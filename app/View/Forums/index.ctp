<?php foreach($forums as $category): ?>
	<div class="forum_category">
    	<?php echo $this->Html->link($category['Forum']['name'], array('controller' => 'forums', 'action' => 'category', $category['Forum']['id'])); ?>
    	<div class="forum_category_logo"></div>
	</div>
	
<?php endforeach; ?>