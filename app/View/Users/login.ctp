<!-- Since the container is only 760px wide, it contains only 13 grids! -->
<div class="login_container">
	<div class="login_header">
		<h2>Utvecklarkollektivet</h2>
		<div class="login_logo"></div>
	</div>
	<div class="login_content">
	<?php
	echo $this->Form->create(
		'User', 
		array('url' => 
			array(
				'controller' => 'users', 
				'action' => 'login')
		)
	);
	?>
	<div class="grid_10 prefix_1 suffix_1">
		<?php
		echo $this->Form->input(
			'User.username', 
			array(
				'label' => false, 
				'class' => 'login_usr_icon login_field', 
				'placeholder' => 'Användarnamn...'
			)
		);
		echo $this->Form->input(
			'User.password', 
			array(
				'label' => false, 
				'class' => 'login_pwd_icon login_field', 
				'placeholder' => 'Lösenord...'
			)
		);
		?>
	</div>
	<div class="clear"></div>
		<?php
		echo $this->Form->button(
			'Glömt lösenord?', 
			array('class' => 'login_button login_forgot_pass')
		);
		echo $this->Form->submit(
			'Logga in', 
			array('class' => 'login_button login_submit', 'div' => false)
		);
		?>
	<?php
	echo $this->Form->end();
	?>
	<div class="clear"></div>
	<?php
	if (!empty($validationErrors)) {
	?>
		<div class="clear_both"></div>
		<?php
		foreach($validationErrors as $field => $errors) {
		?>
			<div class="error_message">
				<?php echo $errors[0]; ?>
			</div>
		<?php
		}
		?>
	<?php
	}
	?>
	<p>Har du en registreringsnyckel? <a href="/users/add/">Registrera dig här</a>.</p>
	<h1>Välkommen till forum-utvecklarkollektivet</h1>
	<h6>Detta är ett stängt community, det innebär att enbart medlemmar har tillgång till innehållet på websidan.</h6>
	<div class="clear"></div>
	</div> <!-- end .login_content -->
</div><!-- end .login_container -->
<div id="footer">
	© Copyright, 2012 <a href="#">forum-utvecklarkollektivet</a><br />
	OBS, denna sidan använder cookies. För att veta mer om cookies tryck
	<a href="#">här</a>
</div>
