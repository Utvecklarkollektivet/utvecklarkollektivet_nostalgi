<h1 class="grid_12">Skapa grupp</h1>
<div class="clear"></div>

<div class="grid_4">
    <?php echo $this->Form->create('Group'); ?>
        <?php
            echo $this->Form->input(
                'name', 
                array(
                    'label' => false, 
                    'placeholder' => 'Gruppnamn...', 
                    'error' => false,
                    'class' => 'input_field'
                ));
        ?>
    <?php echo $this->Form->end(__('Submit')); ?>

    <?php
    if (!empty($validationErrors)) { ?>
        <div class="clear_both"></div>
        <?php
        foreach($validationErrors as $field => $errors) { ?>
            <div class="error_message">
                <?php echo $errors[0]; ?>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<div class="grid_4">
    <h3>Hur fungerar detta?</h3>
    <p>En grupp kan innehåller användare, gruppens privilegier återspeglas på användarna. Ge alltid gruppen ett namn
    som återspeglar gruppens innehåll. T.ex: Medlemar, Moderatorer och Administratörer.</p>
    <p>Ett gruppnamn får innehålla bokstäver, siffror, mellanslag och understreck.</p>
</div>
