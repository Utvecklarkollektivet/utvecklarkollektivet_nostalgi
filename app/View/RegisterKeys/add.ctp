<h1>Skapa registreringsnyckel</h1>
<div class="row">
	<div class="span4">
		<?php echo $this->Form->create('RegisterKey'); ?>
			<h3>Kommentar för nyckeln</h3>
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
		<?php 
			$options = array(
			    'label' => 'Skapa Registreringsnyckel',
			    'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options); 
		?>
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
	<div class="span6 fix_top_box alert alert-info">
		<h3 class="box_fix_top">Hur fungerar detta?</h3>
		<p>För att registrera sig på sajten krävs en "Registreringsnyckel", dessa skapas här!
		Skriv en kommentar så att du och alla andra administratörer vet vem nyckeln är tillägnad. 
		Associera nyckeln med en grupp, när en användare registrerar sig med nyckeln blir användaren 
		automatiskt medlem i denna grupp.</p>
	</div>
</div>
