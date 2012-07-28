<h1 class="grid_12" style="margin-bottom: 0px;">Grupp: <?php echo $group['Group']['name']; ?></h1>
<div class="grid_12" style="color: #999; position: relative; top: -5px;">
    (id: <?php echo $group['Group']['id']; ?> - 
     Skapad: <?php echo $group['Group']['created']; ?> - 
     <?php echo $this->Html->link('Editera', array('controller' => 'groups', 'action' => 'edit', $group['Group']['id'])); ?>)
</div>
<div class="clear"></div>

<h3 class="grid_12">Medlemmar</h3>
<div class="clear"></div>

<?php
    foreach ($users as $user): ?>
    <?php $user = $user['User']; ?>
        <div class="grid_3"><?php echo $this->Html->link($user['username'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?></div>
<?php endforeach; ?>
