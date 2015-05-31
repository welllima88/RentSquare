<div class="top_head">
	Add New Payment Method
</div><!-- .top_head -->
<div class="block_title payment_meth_title">
	<?php echo $this->Html->link(h('Bank Account'),array('controller' => 'PaymentMethods', 'action' => 'add_bank','full_base' => true));?>
	<?php echo $this->Html->link(h('Credit Card'),array('controller' => 'PaymentMethods', 'action' => 'add_cc','full_base' => true),array('class'=>'active'));?>
</div><!-- .block_title -->
<div class="gray_block" style="padding-top: 17px;">
We accept Discover, Visa, and MasterCard. &nbsp;<?php echo $this->Html->image('credit_cards.png', array('alt' => 'Accepted Credit Cards','class'=>'credit_cards_icons')); ?>
<div class="clear"></div><br>
<div class="check_img">
    <?php echo $this->Html->image('csv_hint.png', array('alt' => 'CSV hint','class'=>'csv_hint')); ?>
  </div>
<div class="paymentMethods form">
<?php echo $this->Form->create('PaymentMethod');?>
	<fieldset>
	<?php
		echo $this->Form->hidden('type', array('value'=>'CC'));
		echo $this->Form->hidden('user_id',array('value'=>$user_id));
		echo $this->Form->input('first_name',array('div'=>array('class'=>'half_width'),'class'=>'validate[required]','value'=> $user['first_name']));
		echo $this->Form->input('last_name',array('div'=>array('class'=>'half_width_last'),'class'=>'validate[required]','value'=> $user['last_name']));
		echo $this->Form->input('card_number',array('label'=>'Credit Card Number','class'=>'input_full  validate[required,creditCard]'));
		echo $this->Form->input('expire_dt_month',array('label'=>'Expiration Month','type'=>'select','options'=>array('01'=>'01 - Jan', '02'=>'02 - Feb', '03'=>'03 - Mar', '04'=>'04 - Apr', '05'=>'05 - May', '06'=>'06 - Jun', '07'=>'07 - Jul', '08'=>'08 - Aug', '09'=>'09 - Sept', '10'=>'10 - Oct', '11'=>'11 - Nov', '12'=>'12 - Dec'),'div'=>array('class'=>'half_width')));
		echo '<div class="half_width_last"><label for="PaymentMethodExpireDtYearYear">Expiration Year</label>';
		echo $this->Form->year('expire_dt_year',date('Y'),date('Y', strtotime('+ 9 years')),array('default'=>date('Y'),'div'=>array('class'=>'half_width_last')));
		echo '</div>';
		echo $this->Form->input('security_code',array('div'=>array('class'=>'half_width'),'class'=>'validate[required]'));
		echo $this->Html->link(h("What's This?"),'#sec_code',array('class'=>'half_width_last sec_code','escape'=>false));
		echo '<div class="clear"></div>';
		echo $this->Form->input('billing_address1',array('label'=>'Billing Address','class'=>'input_full  validate[required]','value'=> $user['Property']['address']));
		echo $this->Form->input('billing_address2',array('label'=>'Billing Address 2','class'=>'input_full','value'=> 'Unit '.$user['Unit']['number']));
		echo $this->Form->input('billing_city',array('div'=>array('class'=>'half_width'),'class'=>'validate[required]','value'=> $user['Property']['city']));
		echo $this->Form->input('billing_state_id',array('type'=>'select','options'=>$billingStates,'default'=> $user['Property']['state_id'],'div'=>array('class'=>'half_width_last')));
		echo '<div class="clear"></div>';
		echo $this->Form->input('billing_zip',array('label'=>'Billing Zip','class'=>'validate[required]','value'=> $user['Property']['zip']));
		//echo $this->Form->input('description',array('label'=>'Account Description','class'=>'input_full  validate[required]'));
		?>
    <br>
    <?php
		echo $this->Form->hidden('description', array('value'=>''));
    echo $this->Form->input('default_method',array('label'=>'Set this Credit Card as your default payment method.'));
	?>
	</fieldset>
	<br>
<?php echo $this->Form->submit(__('Save Credit Card'),array('class'=>'btn btn-success'));
    echo $this->Form->end();?>
</div>
<div class="clear"></div>
</div><!-- block_content -->

<script>
jQuery('a.sec_code').click(function(e){
	e.preventDefault();
	jQuery('.csv_hint').fadeToggle();
});
</script>