<h1>Lägg till Kategori</h1>
<div class="row">	
	<div class="span5">
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
		echo $this->Form->input('description');
		echo $this->Form->input('hidden');
		?>
		<?php 
			$options = array(
			    'label' => 'Spara',
			    'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options); 
		?>
	</div>
	<div class="span6 alert warning">
		Om du vill skapa en underkategori, låt "Forum" vara tomt och välj förälderkategorin under "Forum Category".
		Vice versa ifall du inte vill skapa en underkategori.
	</div>
</div>
