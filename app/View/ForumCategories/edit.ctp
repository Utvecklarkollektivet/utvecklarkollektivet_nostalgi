<h1>Ändra en kategori</h1>
<div class="row">
	
	<div class="span7">
		<?php 
		echo $this->Form->create('ForumCategory');
		echo $this->Form->input('forum_id', array(
			'options' => $forums,
			'selected' => $selectedForum,
			'empty' => 'Välj Forum'
		)); 
		echo $this->Form->input('forum_category_id', array(
			'options' => $categories,
			'selected' => $selectedForumCategory,
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
 