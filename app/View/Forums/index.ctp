<h1>Kategorier</h1>
<?php foreach($forums as $category): ?>

    <?php echo $this->Html->link($category['Forum']['name'], array('controller' => 'forums', 'action' => 'category', $category['Forum']['id'])); ?>
	
<?php endforeach; ?>