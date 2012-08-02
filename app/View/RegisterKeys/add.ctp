<h1 class="grid_12">Skapa registreringsnyckel</h1>
<div class="clear"></div>

<div class="grid_4">
	<?php echo $this->Form->create('RegisterKey'); ?>
		<?php
			echo $this->Form->input(
				'comment',
				array(
					'label' => false,
					'error' => false,
					'placeholder' => '(Frivillig) Kommentar...'
				)
			);
			echo $this->Form->input(
				'group_id', 
				array(
					'label' => false,
					'error' => false,
					'options' => $groups, 
					'empty' => 'Välj en grupp...'
				)
			);
		?>
	<?php echo $this->Form->end('Skapa'); ?>
	<?php
	if (!empty($validationErrors)) {
	?>
		<div class="clear_both"></div>
		<div class="error_message">
			Du måste välja en giltig grupp för användaren...
		</div>
	<?php
	}
	?>
</div>
<div class="grid_4">
	<h3>Hur fungerar detta?</h3>
	<p>För att registrera sig på sajten krävs en "Registreringsnyckel", dessa skapas här!
	Skriv en kommentar så att du och alla andra administratörer vet vem nyckeln är tillägnad. 
	Associera nyckeln med en grupp, när en användare registrerar sig med nyckeln blir användaren 
	automatiskt medlem i denna grupp.</p>
</div>
