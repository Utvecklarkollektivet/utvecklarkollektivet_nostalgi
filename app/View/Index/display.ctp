<?php foreach ($news as $item):
		$comments_count = count($item['comments']);
 ?>
	
	<div class="repeatable-item">
		<div class="row-fluid">
			<div class="span12">
				<div class="newsitem">
					<h1 class="item-header"><a href="/news/<?=$item['News']['url'];?>"><?=$item['News']['title'];?></a></h1>
					<div class="clearfix"></div>
					<a href="/news/<?=$item['News']['url'];?>"><img src="<?=$item['images'][0]['link'];?>" alt="<?=$item['images'][0]['title'];?>" class="item-header-pic" /></a>
					<div class="item-text">
						<strong><?=$item['News']['preface'];?></strong>
					</div>
					<div class="subnews">
						<a href="#comments"><?=$comments_count;?> Kommentarer</a> - Senaste: <i><?=utf8_encode(substr($item['comments'][$comments_count - 1]['content'], 0, 255));?></i>
					</div>
				</div>
			</div>
			<div class="span6">
				
			</div>
		</div>
	</div>
<?php endforeach; ?>
