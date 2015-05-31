<div class="failedPayments index">
	<h2><?php echo __('Failed Payments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('billing_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unit_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('ppresponse'); ?></th>
			<th><?php echo $this->Paginator->sort('ppresponsetext'); ?></th>
			<th><?php echo $this->Paginator->sort('ppauthcode'); ?></th>
			<th><?php echo $this->Paginator->sort('pptransactionid'); ?></th>
			<th><?php echo $this->Paginator->sort('ppresponse_code'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($failedPayments as $failedPayment): ?>
	<tr>
		<td><?php echo h($failedPayment['FailedPayment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($failedPayment['Billing']['id'], array('controller' => 'billing', 'action' => 'view', $failedPayment['Billing']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($failedPayment['Unit']['id'], array('controller' => 'units', 'action' => 'view', $failedPayment['Unit']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($failedPayment['User']['id'], array('controller' => 'users', 'action' => 'view', $failedPayment['User']['id'])); ?>
		</td>
		<td><?php echo h($failedPayment['FailedPayment']['amount']); ?>&nbsp;</td>
		<td><?php echo h($failedPayment['FailedPayment']['ppresponse']); ?>&nbsp;</td>
		<td><?php echo h($failedPayment['FailedPayment']['ppresponsetext']); ?>&nbsp;</td>
		<td><?php echo h($failedPayment['FailedPayment']['ppauthcode']); ?>&nbsp;</td>
		<td><?php echo h($failedPayment['FailedPayment']['pptransactionid']); ?>&nbsp;</td>
		<td><?php echo h($failedPayment['FailedPayment']['ppresponse_code']); ?>&nbsp;</td>
		<td><?php echo h($failedPayment['FailedPayment']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $failedPayment['FailedPayment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $failedPayment['FailedPayment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $failedPayment['FailedPayment']['id']), null, __('Are you sure you want to delete # %s?', $failedPayment['FailedPayment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Failed Payment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Billing'), array('controller' => 'billing', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billing'), array('controller' => 'billing', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
