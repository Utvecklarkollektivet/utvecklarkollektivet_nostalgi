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
					array('url' => 
						array(
							'controller' => 'users', 
							'action' => 'login')
					)
				);
				?>
				<div class="login_inputs">
					<div class="input-prepend">
						<span class="add-on"><span class="icon-user"></span></span>
						<?php
						echo $this->Form->input(
							'User.username', 
							array(
								'label' => false, 
								'div' => false,
								'class' => 'login_usr_icon span3', 
								'placeholder' => 'Användarnamn...',
								'id' => 'prependedInput'
							)
						);
						?>
					</div>
					<div class="input-prepend">
						<span class="add-on"><span class="icon-lock"></span></span>
						<?php
						echo $this->Form->input(
							'User.password', 
							array(
								'label' => false,
								'div' => false,
								'class' => 'login_pwd_icon span3 last_input', 
								'placeholder' => 'Lösenord...',
								'id' => 'prependedInput'
							)
						);
						?>
					</div>
				</div>
				<div class="clear"></div>
					<?php
					echo $this->Form->button(
						'Glömt lösenord?', 
						array('class' => 'btn')
					);
					echo $this->Form->submit(
						'Logga in', 
						array('class' => 'btn btn-primary', 'div' => false)
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
				<p class="small">Har du en registreringsnyckel? <a href="/users/add/">Registrera dig här</a>.</p>
			</div> <!-- end .span4 -->
			<div class="span4">
				<p class="bold">Välkommen till forum-utvecklarkollektivet</p>
				<p>Detta är ett stängt community, det innebär att enbart medlemmar har tillgång till innehållet på websidan.</p>
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

		<script>
			$(document).ready( function(){
			        $.fn.snow();
			});
		</script>
