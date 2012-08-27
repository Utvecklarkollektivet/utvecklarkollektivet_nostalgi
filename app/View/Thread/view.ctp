<?php
$forumGroup = reset($breadcrumbs['ForumGroup']);
$forumGroupId = key($breadcrumbs['ForumGroup']);
$crumbThread = reset($breadcrumbs['ForumThread']);
$crumbThreadId = key($breadcrumbs['ForumThread']);
$this->Html->addCrumb('Forums', '/forums');
$this->Html->addCrumb($forumGroup, '/forums/view/' . $forumGroupId);

foreach($breadcrumbs['ForumCategories'] as $id => $name) {

	$this->Html->addCrumb($name, '/forum_categories/view/' . $id);
}
$this->Html->addCrumb($crumbThread, '/thread/view/' . $crumbThreadId);
?>
<div class="forum_topic"><h3><?php echo $thread['Thread']['topic']; ?></h3></div>

<div class="row">
	<div class="span6">
		<div class="row">
		<p class="span6"><?php echo $thread['Thread']['content']; ?></p>
		</div>
		<div class="row thread_info">
			<p class="small span3"><em><?php echo $this->Time->format('F jS, Y H:i', $thread['Thread']['created']); ?></em></p>
			<p class="small span3">Skriven av: <?php echo $thread['User']['username']; ?>
			<?php echo $this->Html->link('edit', array('controller' => 'thread', 'action' => 'edit', $thread['Thread']['id'])); ?>, 
			<?php echo $this->Html->link('delete', array('controller' => 'thread', 'action' => 'delete', $thread['Thread']['id'])); ?>
		</div>

		<hr />

		<?php foreach($posts as $post): ?>
			<div class="row">
			<p class="span6"><?php echo $post['Post']['content']; ?></p>
			</div>
			<div class="row thread_info">
				<p class="small span3">
					<em>
					<?php echo $this->Time->format('F jS, Y H:i', $post['Post']['created']); ?>
					</em>
				</p>
				<p class="small span3">Skrivet av: <?php echo $post['User']['username']; ?></p>
				<?php echo $this->Html->link('edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?>, 
				<?php echo $this->Html->link('delete', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id'])); ?>
			</div>
			<hr />	
		<?php endforeach; ?>
	</div>
	<div class="span5">
		<h2>Svara</h2>
		<?php
			echo $this->Form->create('Post', array('action' => 'add/' . $thread['Thread']['id']));
			echo $this->Form->input('content', array('label' => false, 'rows' => '8', 'class' => 'text-area-fix'));
		?>
		<?php 
			$options = array(
			    'label' => 'Svara',
			    'class' => 'btn'
			);
			echo $this->Form->end($options); 
		?>
	</div>
</div>