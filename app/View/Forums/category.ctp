<h1>Trådar, BEHÖVS DEN HÄR VIEWN?</h1>

<?php echo $this->Html->link('Skriv ny tråd', array('controller' => 'forums', 'action' => 'write', $this->params['pass'][0])); ?>
<br /><br />
<?php foreach($threads as $thread): ?>

    <?php echo $this->Html->link($thread['Thread']['topic'], array('controller' => 'forums', 'action' => 'view', $thread['Thread']['id'])); ?>
    <!-- Alla inlägg finns i $thread['Thread']['post'] -->
    <br />
	
<?php endforeach; ?>