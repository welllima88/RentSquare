<div class="failedPayments view">
<h2><?php  echo __('Failed Payment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing'); ?></dt>
		<dd>
			<?php echo $this->Html->link($failedPayment['Billing']['id'], array('controller' => 'billing', 'action' => 'view', $failedPayment['Billing']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($failedPayment['Unit']['id'], array('controller' => 'units', 'action' => 'view', $failedPayment['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($failedPayment['User']['id'], array('controller' => 'users', 'action' => 'view', $failedPayment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ppresponse'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['ppresponse']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ppresponsetext'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['ppresponsetext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ppauthcode'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['ppauthcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pptransactionid'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['pptransactionid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ppresponse Code'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['ppresponse_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($failedPayment['FailedPayment']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Failed Payment'), array('action' => 'edit', $failedPayment['FailedPayment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Failed Payment'), array('action' => 'delete', $failedPayment['FailedPayment']['id']), null, __('Are you sure you want to delete # %s?', $failedPayment['FailedPayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Failed Payments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Failed Payment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Billing'), array('controller' => 'billing', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing'), array('controller' => 'billing', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
