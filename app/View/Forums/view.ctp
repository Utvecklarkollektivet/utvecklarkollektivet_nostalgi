<h1><?php echo $thread['Thread']['topic']; ?>, BEHÖVS DEN HÄR VIEWN???</h1>
<p><?php echo $thread['Thread']['content']; ?></p>
<p><em><?php echo $this->Time->format('F jS, Y H:i', $thread['Thread']['created']); ?></em></p>
<p>Skriven av: <?php echo $thread['user']['username']; ?>

<br /><br />
<?php foreach($posts as $post): ?>

     <?php echo $post['user']['username'];?>
     <p><?php echo $post['Post']['content']; ?>
     <br /><em><?php echo $this->Time->format('F jS, Y H:i', $post['Post']['created']); ?></em></p>
     <br /><br />
<?php endforeach; ?>

<h2>Svara</h2>
<?php
    echo $this->Form->create('Forum', array('action' => 'add/' . $thread['Thread']['id']));
    ?>
    <div class="input text">
		<label for="ForumContent">Content</label>
		<textarea name="data[Post][content]" rows="3" cols="30" id="ForumContent"></textarea>
	</div>
    <?php
    echo $this->Form->end('Save Post');
?>