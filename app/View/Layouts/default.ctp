<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('generic');

		echo $this->Html->script('jquery-1.7.2');
		echo $this->Html->script('generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="header_container">
		<div id="header_content">
			<div class="header_logo"></div>
			<h4 class="main_header_text">Utvecklarkollektivet</h4>
			<div class="mainmenu">
				<?php echo $this->Menu->generate($menu); ?>
			</div>
			<div class="clearfix"></div>
			<div class="darkstroke"></div>
			<div class="lightstroke"></div>
			<!-- Menyn behöver fixas -->
			<div class="auth_menu">
				<ul>
					<li><a href="#">Profil</a></li>
					<li><a href="#">Inställningar</a></li>
					<li><a href="users/logout">Logga ut</a></li>
				</ul>
			</div>
		</div>
	</div> <!-- End of #HeaderContainer -->

		<div id="container">
			<?php echo $this->Html->getCrumbs(' > ', 'Home'); ?>
			<?php echo $this->fetch('content'); ?>
			<div class="clearfix"></div>
		</div>
		<div id="footer">
			© Copyright, 2012 <a href="#">forum-utvecklarkollektivet</a><br />
			OBS, denna sidan använder cookies. För att veta mer om cookies tryck
		<a href="#">här</a>
		</div>
</body>
</html>
