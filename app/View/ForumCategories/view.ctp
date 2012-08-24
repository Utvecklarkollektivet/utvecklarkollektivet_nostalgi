<div class="forum_category">
	<?php echo $this->Html->link($forumCategories['Forum']['name'], array('controller' => 'forums', 'action' => 'f', $forumCategories['Forum']['id'])); ?>
	<div class="forum_category_logo"></div>
</div>

<h2>Kategori: <?php echo $forumCategories['ForumCategory']['name']; ?></h2>

<h3>Subkategorier</h3>
<?php foreach($forumCategories['ChildForumCategories'] as $c): ?>
	<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?><br />
<?php endforeach; ?>
<?php echo $this->Html->link('Skriv ny tråd', array('controller' => 'thread', 'action' => 'write')); ?>
<h3>Trådar i denna kategori:</h3>
<?php foreach($forumCategories['Thread'] as $t): ?>
	<?php echo $this->Html->link($t['id'], array('controller' => 'thread', 'action' => 'view', $t['id'])); ?>, <?php echo $t['topic']; ?>

<?php endforeach; ?>