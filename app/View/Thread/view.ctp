<h1>Read single thread</h1>
Skriv ut thread här..

<h2><?php echo $thread['Thread']['topic']; ?></h2>
<p><?php echo $thread['Thread']['content']; ?></p>
<p><em><?php echo $this->Time->format('F jS, Y H:i', $thread['Thread']['created']); ?></em></p>
<p>Skriven av: <?php echo $thread['User']['username']; ?>

<br />
<h2>Svar</h2>
<?php foreach($posts as $post): ?>
	 <?php echo $post['User']['username']; ?>, <?php echo $post['Post']['content']; ?>, <em><?php echo $this->Time->format('F jS, Y H:i', $post['Post']['created']); ?></em>
	<hr />
	
<?php endforeach; ?>
<h2>Svara</h2>
<?php
	echo $this->Form->create('Post', array('action' => 'add/' . $thread['Thread']['id']));
	echo $this->Form->input('content', array('rows' => '3'));
	echo $this->Form->end('Save Post');
?>
