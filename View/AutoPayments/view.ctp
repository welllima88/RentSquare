<div class="autoPayments view">
<h2><?php  echo __('Auto Payment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($autoPayment['User']['id'], array('controller' => 'users', 'action' => 'view', $autoPayment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Method'); ?></dt>
		<dd>
			<?php echo $this->Html->link($autoPayment['PaymentMethod']['type'], array('controller' => 'payment_methods', 'action' => 'view', $autoPayment['PaymentMethod']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($autoPayment['AutoPayment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Auto Payment'), array('action' => 'edit', $autoPayment['AutoPayment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Auto Payment'), array('action' => 'delete', $autoPayment['AutoPayment']['id']), null, __('Are you sure you want to delete # %s?', $autoPayment['AutoPayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Auto Payments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Auto Payment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Methods'), array('controller' => 'payment_methods', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Method'), array('controller' => 'payment_methods', 'action' => 'add')); ?> </li>
	</ul>
</div>
