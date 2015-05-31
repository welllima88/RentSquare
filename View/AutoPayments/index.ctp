<div class="autoPayments index">
	<h2><?php echo __('Auto Payments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($autoPayments as $autoPayment): ?>
	<tr>
		<td><?php echo h($autoPayment['AutoPayment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($autoPayment['User']['id'], array('controller' => 'users', 'action' => 'view', $autoPayment['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($autoPayment['PaymentMethod']['type'], array('controller' => 'payment_methods', 'action' => 'view', $autoPayment['PaymentMethod']['id'])); ?>
		</td>
		<td><?php echo h($autoPayment['AutoPayment']['active']); ?>&nbsp;</td>
		<td><?php echo h($autoPayment['AutoPayment']['amount']); ?>&nbsp;</td>
		<td><?php echo h($autoPayment['AutoPayment']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($autoPayment['AutoPayment']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($autoPayment['AutoPayment']['created']); ?>&nbsp;</td>
		<td><?php echo h($autoPayment['AutoPayment']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $autoPayment['AutoPayment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $autoPayment['AutoPayment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $autoPayment['AutoPayment']['id']), null, __('Are you sure you want to delete # %s?', $autoPayment['AutoPayment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Auto Payment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Methods'), array('controller' => 'payment_methods', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Method'), array('controller' => 'payment_methods', 'action' => 'add')); ?> </li>
	</ul>
</div>
