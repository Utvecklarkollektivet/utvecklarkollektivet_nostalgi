<div class="registerKeys view">
<h2><?php  echo __('Register Key'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($registerKey['RegisterKey']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($registerKey['RegisterKey']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($registerKey['RegisterKey']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($registerKey['RegisterKey']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Id'); ?></dt>
		<dd>
			<?php echo h($registerKey['RegisterKey']['group_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Register Key'), array('action' => 'edit', $registerKey['RegisterKey']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Register Key'), array('action' => 'delete', $registerKey['RegisterKey']['id']), null, __('Are you sure you want to delete # %s?', $registerKey['RegisterKey']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Register Keys'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Register Key'), array('action' => 'add')); ?> </li>
	</ul>
</div>
