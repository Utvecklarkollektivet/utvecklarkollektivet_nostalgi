<?php
echo $this->Form->create(
	'User',
	array(
		'controller' => 'users',
		'action' => 'add'
	)
);
?>
<div class="grid_6 prefix_1 suffix_1" style="text-align: center;">
	<?php
	echo $this->Form->input(
		'username',
		array(
			'label' => false,
			'class' => 'login_field login_usr_icon',
			'placeholder' => 'Användarnamn...',
			'error' => false
		)
	);
	echo $this->Form->input(
		'password',
		array(
			'label' => false,
			'class' => 'login_field login_pwd_icon',
			'placeholder' => 'Lösenord...',
			'error' => false
		)
	);
	echo $this->Form->input(
		'activation',
		array(
			'label' => false,
			'class' => 'login_field login_act_icon',
			'placeholder' => 'Registreringsnyckel...'
		)
	);
	?>
</div>
<div class="clear"></div>
<div class="grid_6 prefix_1 suffix_1" style="text-align: right;">
	<?php
	echo $this->Form->submit(
		'Registrera',
		array(
			'class' => 'login_button login_submit',
			'div' => false
		)
	);
	?>
</div>
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
<div class="clear"></div>
<div class="grid_6 prefix_1 suffix_1" style="font-size: 10px; color: #666666; text-align: center; padding-top: 20px;">
	Har du redan ett konto? <a href="/users/login/">Logga in här</a>.
</div>
