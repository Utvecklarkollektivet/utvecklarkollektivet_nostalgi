<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="topborder"></div>
    <center>
        <?php echo $this->fetch('content'); ?>
    <div id="footer">
        © Copyright, 2012 <a href="#">forum-utvecklarkollektivet</a><br />
        OBS, denna sidan använder cookies. För att veta mer om cookies tryck
        <a href="#">här</a>
    </div>
	</center>
</body>
</html>
