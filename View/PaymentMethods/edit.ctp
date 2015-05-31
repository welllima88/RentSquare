<div class="paymentMethods form">
<?php echo $this->Form->create('PaymentMethod');?>
	<fieldset>
		<legend><?php echo __('Edit Payment Method'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('type');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('card_num');
		echo $this->Form->input('expire_dt_month');
		echo $this->Form->input('expire_dt_day');
		echo $this->Form->input('security_code');
		echo $this->Form->input('billing_address1');
		echo $this->Form->input('billing_address2');
		echo $this->Form->input('billing_city');
		echo $this->Form->input('billing_state_id');
		echo $this->Form->input('billing_zip');
		echo $this->Form->input('bank_name');
		echo $this->Form->input('account_num');
		echo $this->Form->input('routing_num');
		echo $this->Form->input('bank_acct_type');
		echo $this->Form->input('default_method');
		echo $this->Form->input('recurring');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
