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
	<?php if($_SERVER['SERVER_NAME'] == 'dev.utvecklarkollektivet.se' || $_SERVER['SERVER_NAME'] == 'beta.utvecklarkollektivet.se'): ?>
		<div class="alert alert-warning text-center">
			Observera att detta är endast en utvecklingsversion av utvecklarkollektivet. Den riktiga sajten hittar ni på <a href="http://utvecklarkollektivet.se">www.utvecklarkollektivet.se</a>
		</div>
	<?php endif; ?>
	<div id="header_container">
		<div id="header_content">
			<div class="header_logo"></div>
			<h4 class="main_header_text"><a href="/">Utvecklarkollektivet</a></h4>
			<div class="clearfix"></div>
		</div>
	</div> <!-- End of #HeaderContainer -->
	<div id="menubackground">
		<div class="mainmenu">
			<?php echo $this->Menu->generateMain($menu); ?>
		</div>
	</div>
		<hr class="stripe" />
		<?php if(!in_array($this->request->params['controller'], array('index', 'news'))): ?>
			<div id="container">
		<?php endif; ?>
			<?php
				if(!in_array($this->request->params['controller'], array('index', 'news')))
					echo $this->Html->getCrumbs(' > ', 'Nyheter'); 
			?>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<div class="clearfix"></div>
		<?php if(!in_array($this->request->params['controller'], array('index', 'news'))): ?>
			</div>
		<?php endif; ?>
		<div id="footer">
			© Copyright, 2012 <a href="#">utvecklarkollektivet</a><br />
			OBS, denna sidan använder cookies. För att veta mer om cookies tryck
		<a href="#">här</a>
		</div>
</body>
</html>
