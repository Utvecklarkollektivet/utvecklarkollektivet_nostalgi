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

echo $this->Form->end('Save category');
?>