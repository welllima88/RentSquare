<div class="paymentMethods view">
<h2><?php  echo __('Payment Method');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Card Num'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['card_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expire Dt Month'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['expire_dt_month']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expire Dt Day'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['expire_dt_day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Security Code'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['security_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Address1'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['billing_address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Address2'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['billing_address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing City'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['billing_city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('States'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paymentMethod['States']['id'], array('controller' => 'states', 'action' => 'view', $paymentMethod['States']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Zip'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['billing_zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Name'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['bank_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Num'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['account_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Routing Num'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['routing_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Acct Type'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['bank_acct_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Default Method'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['default_method']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recurring'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['recurring']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paymentMethod['User']['id'], array('controller' => 'users', 'action' => 'view', $paymentMethod['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment Method'), array('action' => 'edit', $paymentMethod['PaymentMethod']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment Method'), array('action' => 'delete', $paymentMethod['PaymentMethod']['id']), null, __('Are you sure you want to delete # %s?', $paymentMethod['PaymentMethod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Methods'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Method'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New States'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
