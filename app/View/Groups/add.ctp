<?php $this->start('css'); ?>
    <?php echo $this->Html->css('groups'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
    <?php echo $this->Html->script('groups'); ?>
<?php $this->end(); ?>

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
                        'aco-id' => $aco['id']
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
    <h3>Vad är en grupp?</h3>
    <p>En grupp är i praktiken enbart ett namn med en samling privilegier. Användare som är medlem i gruppen
    ärver gruppens alla privilegier.</p>
    
    <h3>Hur sätter man privilegier?</h3>
    <p>Privilegier sätter på 3 olika nivåer. Root, class och action. I vårt fall heter rooten controllers. Om ett privilegie
    sätts på högre nivå än Action, alla action under denna nivå kommer att ingå i privilegiet. Observera! Även framtida action
    kommer att ingå i privilegiet!</p>

    <h3>Exempel: Administratörer</h3>
    <p>För gruppen administratörer sätts privilegiet controllers. Det betyder att gruppen får behörighet till alla actions och
    klasser som finns nu och som läggs till i framtiden.</p>

    <h3>Exempel: Användare</h3>
    <p>För gruppen användare kommer inget klass eller rootprivilegie sättas. Detta skulle resultera i en säkerhetsrisk om ett
    action i framtiden skulle läggas till i en klass med privilegie. Därför sätts enbart actions som privilegie för användare.</p>
</div>
