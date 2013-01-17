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
							echo '<p>' . utf8_encode($comment['content']) . '</p>';
						endforeach;
					?>
				</div>
			</div>
		</div>
		<div class="span6">
			
		</div>
	</div>
</div>