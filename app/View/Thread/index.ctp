<h1>Threads</h1>

<?php foreach($threads as $thread): ?>

	<?php echo $thread['Thread']['id']; ?>, <?php echo $thread['Thread']['topic']; ?>
	<!-- Alla inl�gg finns i $thread['Thread']['inlay'] -->
	<hr />
	
<?php endforeach; ?>