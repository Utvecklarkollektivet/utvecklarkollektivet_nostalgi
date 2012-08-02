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
<div class="grid_6 prefix_1 suffix_1" style="text-align: center;">
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
<div class="grid_6 prefix_1 suffix_1" style="text-align: right;">
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
</div>
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
<div class="grid_6 prefix_1 suffix_1" style="font-size: 10px; color: #666666; text-align: center; padding-top: 20px;">
	Har du en registreringsnyckel? <a href="/users/add/">Registrera dig här</a>.
</div>
