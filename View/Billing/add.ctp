<div class="billingCycles form">
<?php echo $this->Form->create('Billing');?>
	<fieldset>
		<legend><?php echo __('Add Billing Cycle'); ?></legend>
	<?php
		echo $this->Form->input('unit_id');
		echo $this->Form->input('rent_due');
		echo $this->Form->input('status');
		echo $this->Form->input('billing_start');
		echo $this->Form->input('billing_end');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Billing Cycles'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
