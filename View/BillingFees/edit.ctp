<div class="billingFees form">
<?php echo $this->Form->create('BillingFee'); ?>
	<fieldset>
		<legend><?php echo __('Edit Billing Fee'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('billing_cycles_id');
		echo $this->Form->input('name');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BillingFee.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BillingFee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Billing Fees'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Billing Cycles'), array('controller' => 'billing_cycles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing Cycles'), array('controller' => 'billing_cycles', 'action' => 'add')); ?> </li>
	</ul>
</div>
