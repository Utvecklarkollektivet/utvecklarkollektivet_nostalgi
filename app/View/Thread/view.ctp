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
	<div class="span7">
		<div class="row">
			<p class="span7"><?php echo $thread['Thread']['content']; ?></p>
		</div>
		<div class="row thread_info">
			<p class="small span2"><em><?php echo $this->Time->format('F jS, Y H:i', $thread['Thread']['created']); ?></em></p>
			<p class="small span4">Skriven av: <?php echo $thread['User']['username']; ?></p>
			<p class="span1">
				<?php echo $this->Html->link('edit', array('controller' => 'thread', 'action' => 'edit', $thread['Thread']['id']), array('class' => 'icon-edit hiddentext')); ?>
				<?php echo $this->Html->link('delete', array('controller' => 'thread', 'action' => 'delete', $thread['Thread']['id']), array('class' => 'icon-remove hiddentext')); ?>
			</p>
		</div>

		<hr />

		<?php foreach($posts as $post): ?>
			<div class="row">
			<p class="span7"><?php echo $post['Post']['content']; ?></p>
			</div>
			<div class="row thread_info">
				<p class="small span2">
					<em>
					<?php echo $this->Time->format('F jS, Y H:i', $post['Post']['created']); ?>
					</em>
				</p>
				<p class="small span4">Skrivet av: <?php echo $post['User']['username']; ?></p>
				<p class="span1">
					<?php echo $this->Html->link('edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']), array('class' => 'icon-edit hiddentext')); ?> 
					<?php echo $this->Html->link('delete', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), array('class' => 'icon-remove hiddentext')); ?>
				</p>
			</div>
			<hr />	
		<?php endforeach; ?>
		<div class="pagination">
			<ul>
				<?php
					echo $this->Paginator->prev('< Föregående ', array('tag' => 'li', 'class' => ''), null, array('tag' => 'li'));
					echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active'));
					echo $this->Paginator->next(' Nästa >', array('tag' => 'li', 'class' => ''), null, array('tag' => 'li'));
				?>
			</ul>
		</div>
	</div>
	<div class="span4">
		<h2>Svara</h2>
		<?php
			echo $this->Form->create('Post', array('action' => 'add/' . $thread['Thread']['id']));
			echo $this->Form->input('content', array('label' => false, 'rows' => '8', 'class' => 'text-area-fix-small'));
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