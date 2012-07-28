<?php $this->start('css'); ?>
    <?php echo $this->Html->css('groups'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
    <?php echo $this->Html->script('groups'); ?>
<?php $this->end(); ?>

<h1 class="grid_12">Editera grupp: <?php echo $this->data['Group']['name']; ?></h1>
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
        <div class="list">
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
        </div>
        
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
