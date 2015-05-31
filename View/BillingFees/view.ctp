<div class="billingFees view">
<h2><?php  echo __('Billing Fee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($billingFee['BillingFee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Cycles'); ?></dt>
		<dd>
			<?php echo $this->Html->link($billingFee['BillingCycles']['id'], array('controller' => 'billing_cycles', 'action' => 'view', $billingFee['BillingCycles']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($billingFee['BillingFee']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($billingFee['BillingFee']['amount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Billing Fee'), array('action' => 'edit', $billingFee['BillingFee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Billing Fee'), array('action' => 'delete', $billingFee['BillingFee']['id']), null, __('Are you sure you want to delete # %s?', $billingFee['BillingFee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Billing Fees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing Fee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Billing Cycles'), array('controller' => 'billing_cycles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing Cycles'), array('controller' => 'billing_cycles', 'action' => 'add')); ?> </li>
	</ul>
</div>
