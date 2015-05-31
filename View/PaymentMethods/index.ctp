<div class="paymentMethods index">
	<h2><?php echo __('Payment Methods');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('card_num');?></th>
			<th><?php echo $this->Paginator->sort('expire_dt_month');?></th>
			<th><?php echo $this->Paginator->sort('expire_dt_day');?></th>
			<th><?php echo $this->Paginator->sort('security_code');?></th>
			<th><?php echo $this->Paginator->sort('billing_address1');?></th>
			<th><?php echo $this->Paginator->sort('billing_address2');?></th>
			<th><?php echo $this->Paginator->sort('billing_city');?></th>
			<th><?php echo $this->Paginator->sort('billing_state_id');?></th>
			<th><?php echo $this->Paginator->sort('billing_zip');?></th>
			<th><?php echo $this->Paginator->sort('bank_name');?></th>
			<th><?php echo $this->Paginator->sort('account_num');?></th>
			<th><?php echo $this->Paginator->sort('routing_num');?></th>
			<th><?php echo $this->Paginator->sort('bank_acct_type');?></th>
			<th><?php echo $this->Paginator->sort('default_method');?></th>
			<th><?php echo $this->Paginator->sort('recurring');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($paymentMethods as $paymentMethod): ?>
	<tr>
		<td><?php echo h($paymentMethod['PaymentMethod']['id']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['type']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['card_num']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['expire_dt_month']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['expire_dt_day']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['security_code']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['billing_address1']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['billing_address2']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['billing_city']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentMethod['States']['id'], array('controller' => 'states', 'action' => 'view', $paymentMethod['States']['id'])); ?>
		</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['billing_zip']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['bank_name']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['account_num']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['routing_num']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['bank_acct_type']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['default_method']); ?>&nbsp;</td>
		<td><?php echo h($paymentMethod['PaymentMethod']['recurring']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentMethod['User']['id'], array('controller' => 'users', 'action' => 'view', $paymentMethod['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paymentMethod['PaymentMethod']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paymentMethod['PaymentMethod']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paymentMethod['PaymentMethod']['id']), null, __('Are you sure you want to delete # %s?', $paymentMethod['PaymentMethod']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Method'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New States'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
