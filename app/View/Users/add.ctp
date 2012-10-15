<!-- Since the container is only 760px wide, it contains only 13 grids! -->
<div class="login_container">
	<div class="login_header">
		<h4 class="auth_header_text">Utvecklarkollektivet</h4>
		<div class="darkstroke"></div>
		<div class="lightstroke"></div>
		<div class="login_logo"></div>
	</div>
	<div class="login_content">
		<div class="row">
			<div class="span4 login_left">
				<?php
				echo $this->Form->create(
					'User',
					array(
						'controller' => 'users',
						'action' => 'add'
					)
				);
				?>
				<div class="input-prepend">
					<span class="add-on"><span class="icon-user"></span></span>
					<?php
					echo $this->Form->input(
						'username',
						array(
							'label' => false,
							'div' => false,
							'class' => 'login_field login_usr_icon',
							'placeholder' => 'Användarnamn...',
							'error' => false,
							'id' => 'prependedInput'
						)
					);
					?>
				</div>
				<div class="input-prepend">
					<span class="add-on"><span class="icon-lock"></span></span>
					<?php
					echo $this->Form->input(
						'password',
						array(
							'label' => false,
							'div' => false,
							'class' => 'login_field login_pwd_icon',
							'placeholder' => 'Lösenord...',
							'error' => false,
							'id' => 'prependedInput'
						)
					);
					?>

				</div>
				<div class="input-prepend">
					<span class="add-on"><span class="icon-envelope"></span></span>
					<?php
					echo $this->Form->input(
						'email',
						array(
							'label' => false,
							'div' => false,
							'class' => 'login_field login_act_icon',
							'placeholder' => 'Email...',
							'error' => false,
							'id' => 'prependedInput',
						)
					);
					?>
				</div>
				<div class="input-prepend">
					<span class="add-on"><span class="icon-wrench"></span></span>
					<?php
					echo $this->Form->input(
						'activation',
						array(
							'label' => false,
							'div' => false,
							'class' => 'login_field login_act_icon',
							'placeholder' => 'Registreringsnyckel...',
							'id' => 'prependedInput'
						)
					);
					?>
				</div>
				<div class="clear"></div>
					<?php
					echo $this->Form->submit(
						'Registrera',
						array(
							'class' => 'btn btn-primary',
							'div' => false
						)
					);
					?>
				<?php
				echo $this->Form->end();

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
				<p class="small">Har du redan ett konto? <a href="/users/login/">Logga in här</a></p>
				</div> <!-- end .span4 .login_left -->
				<div class="span4">
					<p class="bold">Registreringsnyckel</p>
					<p>För att få en registreringsnyckel måste du ha kontakt med en administratör för Utvecklarkollektivet</p>
					<p class="small">Utvecklarkollektivet är ett stängt forum</p>
				</div> <!-- end .span4 -->
			<div class="clear"></div>
		</div> <!-- end .row -->
	</div> <!-- end .login_content -->
</div><!-- end .login_container -->
<div id="footer">
	© Copyright, 2012 <a href="#">forum-utvecklarkollektivet</a><br />
	OBS, denna sidan använder cookies. För att veta mer om cookies tryck
	<a href="#">här</a>
</div>
