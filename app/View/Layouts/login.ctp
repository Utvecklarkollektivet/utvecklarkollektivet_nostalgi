<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('clear');
		echo $this->Html->css('text');
		echo $this->Html->css('960');
		echo $this->Html->css('generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<!-- Since the container is only 640px wide, it contains only 8 grids! -->
	<div class="container_12 login_container">
		<div class="grid_8">
			<h1>Välkommen till forum-utvecklarkollektivet</h1>
			<h6>Detta är ett stängt community, det innebär att enbart medlemmar har tillgång till innehållet på websidan.</h6>
		</div>

		<?php echo $this->fetch('content'); ?>
		<div class="clear"></div>
	</div>

	<div id="footer">
		© Copyright, 2012 <a href="#">forum-utvecklarkollektivet</a><br />
		OBS, denna sidan använder cookies. För att veta mer om cookies tryck
		<a href="#">här</a>
	</div>
</body>
</html>
