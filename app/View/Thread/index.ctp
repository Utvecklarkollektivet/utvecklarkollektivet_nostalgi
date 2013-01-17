<h1>Threads, DENNA SKALL EJ ANVÄNDAS, TA BORT?</h1>

<?php echo $this->Html->link('Skriv ny tråd', array('controller' => 'thread', 'action' => 'write')); ?>
<br />
<?php foreach($threads as $thread): ?>

	<?php echo $this->Html->link($thread['Thread']['id'], array('controller' => 'thread', 'action' => 'view', $thread['Thread']['id'])); ?>, <?php echo $thread['Thread']['topic']; ?>
	<!-- Alla inlägg finns i $thread['Thread']['post'] -->
	<hr />
	
<?php endforeach; ?>
