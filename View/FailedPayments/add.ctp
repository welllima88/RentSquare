<div class="failedPayments form">
<?php echo $this->Form->create('FailedPayment'); ?>
	<fieldset>
		<legend><?php echo __('Add Failed Payment'); ?></legend>
	<?php
		echo $this->Form->input('billing_id');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('ppresponse');
		echo $this->Form->input('ppresponsetext');
		echo $this->Form->input('ppauthcode');
		echo $this->Form->input('pptransactionid');
		echo $this->Form->input('ppresponse_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Failed Payments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Billing'), array('controller' => 'billing', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing'), array('controller' => 'billing', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
