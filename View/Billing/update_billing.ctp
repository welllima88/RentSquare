<div class="Billings index">
	<h2><?php echo __('Billing Cycles');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('unit_id');?></th>
			<th><?php echo $this->Paginator->sort('rent_due');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('billing_start');?></th>
			<th><?php echo $this->Paginator->sort('billing_end');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($Billings as $Billing): ?>
	<tr>
		<td><?php echo h($Billing['Billing']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($Billing['Unit']['id'], array('controller' => 'units', 'action' => 'view', $Billing['Unit']['id'])); ?>
		</td>
		<td><?php echo h($Billing['Billing']['rent_due']); ?>&nbsp;</td>
		<td><?php echo h($Billing['Billing']['status']); ?>&nbsp;</td>
		<td><?php echo h($Billing['Billing']['billing_start']); ?>&nbsp;</td>
		<td><?php echo h($Billing['Billing']['billing_end']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $Billing['Billing']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Billing['Billing']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Billing['Billing']['id']), null, __('Are you sure you want to delete # %s?', $Billing['Billing']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Billing Cycle'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
