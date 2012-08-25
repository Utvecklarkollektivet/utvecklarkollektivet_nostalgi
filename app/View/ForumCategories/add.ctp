<<<<<<< HEAD
<h1>Add new forum category</h1>
<div class="alert warning">Om du vill skapa en underkategori, låt "Forum" vara tomt och välj förälderkategorin under "Forum Category".
Vice versa ifall du inte vill skapa en underkategori.</div>
<?php 
echo $this->Form->create('ForumCategory');
echo $this->Form->input('forum_id', array(
	'options' => $select_forums,
	'empty' => 'Choose forum'
)); 
echo $this->Form->input('forum_category_id', array(
	'options' => $select_categories,
	'empty' => 'Choose category'
)); 
echo $this->Form->input('name');
echo $this->Form->input('hidden');

echo $this->Form->end('Save category');
?>
=======
<h1>Lägg till Kategori</h1>
<div class="row">
	
	<div class="span7">
		<?php 
		echo $this->Form->create('ForumCategory');
		echo $this->Form->input('forum_id', array(
			'options' => $select_forums,
			'empty' => 'Välj Forum'
		)); 
		echo $this->Form->input('forum_category_id', array(
			'options' => $select_categories,
			'empty' => 'Välj Kategori'
		)); 
		echo $this->Form->input('name');
		echo $this->Form->input('hidden');

		echo $this->Form->end('Save category');
		?>
	</div>
	<div class="span5 alert warning">
		Om du vill skapa en underkategori, låt "Forum" vara tomt och välj förälderkategorin under "Forum Category".
		Vice versa ifall du inte vill skapa en underkategori.
	</div>
</div>
>>>>>>> Forum Styling
