<h1 class="grid_12">Editerar gruppen { <?php echo $this->data['Group']['name']; ?> }</h1>
<div class="clear"></div>

<?php echo $this->Form->create('Group'); ?>
    <div class="grid_12">
        <h3>Generella inställningar</h3>
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
    </div>
    <div class="clear"></div>

    <div class="grid_12">
        <h3>Rättigheter</h3>
        @todo!
    </div>
    <div class="clear"></div>

    <div class="grid_5">
        <?php echo $this->Form->button('Tillbaka', array('type' => 'button', 'onclick' => 'history.go(-1);')); ?>
        <?php echo $this->Form->submit('Spara ändringar', array('div' => false)); ?>
    </div>
<?php echo $this->Form->end(); ?>

<div class="clear"></div>
<div class="grid_4">
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
