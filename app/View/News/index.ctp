<?php $comments_count = count($item['comments']); ?>
<div class="repeatable-item">
	<div class="row-fluid">
		<div class="span12">
			<div class="newsitem">
				<h1 class="item-header"><?=$item['News']['title'];?></h1>
				<div class="clearfix"></div>
				<img src="<?=$item['images'][0]['link'];?>" alt="<?=$item['images'][0]['title'];?>" class="item-header-pic" />
				<div class="item-text">
					<strong><?=$item['News']['preface'];?></strong>
				</div>
				<div class="subnews">
					<h2 id="#comments"><?=$comments_count;?> <?php if($comments_count > 1 || $comments_count == 0): ?> Kommentarer <?php else: ?> Kommentar <?php endif; ?></h2>
					<?php 
						foreach($item['comments'] as $comment):
							echo '<div class="comment">';
							echo '<p class="comment-body">' . utf8_encode($comment['content']) . '</p>';
							echo '<p class="comment-author">' . utf8_encode($comment['user_id']) . ' - skrevs ' . $comment['created']  . '</p>';
							echo '</div>';
						endforeach;
						
						echo '<h2>Skriv en kommentar</h2>';
						echo $this->Form->create('Comment', array('action' => 'add/' . $item['News']['id']));
						echo $this->Form->input('content', array('label' => false, 'rows' => '10', 'class' => 'text-area-fix-small'));
						
						$options = array(
						    'label' => 'Svara',
						    'class' => 'btn'
						);
						echo $this->Form->end($options); 
					?>
				</div>
			</div>
		</div>
		<div class="span6">
			
		</div>
	</div>
</div>