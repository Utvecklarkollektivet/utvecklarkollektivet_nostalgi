<?php $this->Html->addCrumb('Forums', '/forums'); ?>
<?php foreach($forums as $f): ?>
	<div class="forum_category">
    	<?php echo $this->Html->link($f['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $f['Forum']['id'])); ?>
    	<div class="forum_category_logo"></div>
	</div>
	
		<?php $i = 0; foreach($f['ForumCategory'] as $c): ?>
			<div class="row">
				<div class="forum_sub_category">
					<div class="span0_5">
						<span class="icon-th forum_sub_category_icon"></span>
					</div>
					<div class="span5">
						<?php echo $this->Html->link($c['name'], array('controller' => 'forum_categories', 'action' => 'view', $c['id'])); ?>
						<p class="small"><?php echo $c['description']; ?></p>
					</div>
					<div class="span2 forum_sub_category_field forum_sub_category_field_right">
						<p class="bold">X Poster</p>
						<p class="small"><?php echo $c['thread_count']; ?> Trådar</p>
					</div>
					<div class="span3 forum_sub_category_field">
						<?php 
							$posts = false;
							foreach($forums_data as $data):
								if($c['id'] == $data['id'] && $posts == false): ?>
								<p>Senaste post av <a href="/users/view/<?=$forums_data[$i]['data']['latest_poster']['id']?>"><?=$forums_data[$i]['data']['latest_poster']['username']?></a></p>
								<p>I <a href="/thread/view/<?=$forums_data[$i]['data']['latest_thread']['id']?>"><?=$forums_data[$i]['data']['latest_thread']['topic']?></a></p>
								<?php $posts = true; endif; ?>

						<?php endforeach; if(!$posts): ?>
							<p>Bli den första att skriva ett svar/tråd!</p>
						<?php endif; ?>
					</div>
					<div class="span0_5">
					<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/edit')): ?>
						<?php 
							echo $this->Html->link('Edit', array('controller' => 'ForumCategories', 'action' => 'edit', $c['id']), array('class' => 'icon-edit hiddentext')); 
						?>
					<?php endif; ?>
					<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/delete')): ?>
						<?php echo $this->Html->link('Delete', array('controller' => 'ForumCategories', 'action' => 'delete', $c['id']), array('class' => 'icon-remove hiddentext')); ?>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<hr />
		<?php $i++; endforeach; ?>
	
<?php endforeach; ?>
<div class="forum_button">
	<?php if ($acl->check(array('User' => $user), 'controllers/Forums/add')): ?>
		<?php echo $this->Html->link('Skapa forumgrupp', array('controller' => 'Forums', 'action' => 'add'), array('class' => 'btn')); ?>
	<?php endif; ?>

	<?php if ($acl->check(array('User' => $user), 'controllers/ForumCategories/add')): ?>
		<?php echo $this->Html->link('Skapa kategori', array('controller' => 'ForumCategories', 'action' => 'add'), array('class' => 'btn')); ?>
	<?php endif; ?>
</div>