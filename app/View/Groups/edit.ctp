<?php $this->start('css'); ?>
	<?php echo $this->Html->css('groups'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
	<?php echo $this->Html->script('groups'); ?>
<?php $this->end(); ?>

<h1>Editera grupp: <?php echo $this->data['Group']['name']; ?></h1>

<?php echo $this->Form->create('Group'); ?>
<div class="row">
	<div class="span6">
	<h3>Generella inställningar</h3>
	<h4>Gruppnamn</h4>
	<?php
		echo $this->Form->input(
			'name', 
			array(
				'label' => false,
				'error' => false, 
				'placeholder' => 'Gruppnamn...',
				'class' => 'input_field'
			));
	?>

	<h3>Rättigheter</h3>
	<div class="group_list">
	<?php
		$level = array();
		foreach ($acos as $aco) {
			$aco = $aco['acos'];

			if (isset($level[1]) && $level[1] == $aco['parent_id']) {
				array_shift($level);
				echo '</ul>';
			}
			elseif (!isset($level[0]) || $aco['parent_id'] != $level[0]) {
				array_unshift($level, $aco['parent_id']);
				echo '<ul>';
			}
			echo '<li>';

			echo $this->Form->input(
				'permissions', 
				array(
					'name' => "data[Group][permissions][$aco[id]]",
					'type' => 'checkbox',
					'div' => false, 
					'label' => false, 
					'value' => 'true', 
					'parent' => $aco['parent_id'],
					'aco-id' => $aco['id'],
					'checked' => isset($allowed[$aco['id']]) ? 'checked' : false
				)
			);
			echo $aco['alias'];
			echo '</li>';
		}
		foreach ($level as $ul) {
			echo '</ul>';
		}
	?>

	<?php echo $this->Form->button('Tillbaka', array('type' => 'button', 'onclick' => 'history.go(-1);', 'class' => 'btn')); ?>
	<?php echo $this->Form->submit('Spara ändringar', array('div' => false, 'class' => 'btn btn-primary')); ?>
	<?php echo $this->Form->end(); ?>
	</div>

	<div class="span6">
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
	</div>
</div>
