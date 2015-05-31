<div class="top_head">
	Add New Payment Method
</div><!-- .top_head -->
<div class="block_title payment_meth_title">
	<?php echo $this->Html->link(h('Bank Account'),array('controller' => 'PaymentMethods', 'action' => 'add_bank','full_base' => true),array('class'=>'active'));?>
	<?php echo $this->Html->link(h('Credit Card'),array('controller' => 'PaymentMethods', 'action' => 'add_cc','full_base' => true));?>
</div><!-- .block_title -->
<div class="gray_block" style="padding-top: 17px;">
  Please add your bank information below.<br><br>
  <div class="clear"></div>
  <div class="check_img">
    <?php echo $this->Html->image('check.png', array('alt' => 'Sample Check','class'=>'floatRight')); ?>
  </div>
	<div class="paymentMethods form">
  <?php echo $this->Form->create('PaymentMethod');?>
  	<fieldset>
  	
  	<?php
  		echo $this->Form->hidden('type', array('value'=>'ACH'));
  		echo $this->Form->hidden('user_id',array('value'=>$user_id));
  		echo $this->Form->input('account_number',array('div'=>array('class'=>'half_width'),'class'=>'validate[required]'));
  		echo $this->Form->input('routing_number',array('div'=>array('class'=>'half_width_last'),'class'=>'validate[required]','type'=>'text'));
  		echo $this->Form->input('bank_name',array('class'=>'input_full validate[required]'));
  		echo $this->Form->input('first_name',array('label'=>'First Name on Account','div'=>array('class'=>'half_width'),'class'=>'input_full validate[required]','value'=> $user['first_name']));
  		echo $this->Form->input('last_name',array('label'=>'Last Name on Account','div'=>array('class'=>'half_width_last'),'class'=>'input_full validate[required]','value'=> $user['last_name']));
  		echo $this->Form->input('bank_acct_type', array('type'=>'radio','legend' => 'Type of Account','options' => array('Checking'=>'Checking','Savings'=>'Savings'),'class'=>'validate[required]','div'=>array('class'=>'input radio required bank_acct_type'),'default'=>'Checking'));
  		//echo $this->Form->input('description',array('label'=>'Description of Account','class'=>'input_full validate[required]'));
  		?>
      <br>
  		<?php
  		echo $this->Form->hidden('description', array('value'=>''));
  		echo $this->Form->input('default_method',array('label'=>'Set this Bank Account as your default payment method.'));
  	?>
  	</fieldset>
  	<br>
  <?php echo $this->Form->submit(__('Save Bank Account'),array('class'=>'btn btn-success'));
    echo $this->Form->end();?>
  </div>
  <div class="clear"></div>
</div><!-- .block_content -->

<script>
  jQuery('#PaymentMethodRoutingNumber,#PaymentMethodAccountNumber').on('change',function(){
           jQuery(this).val(jQuery(this).val().replace(/-/g,''));
           return true;
  });
</script>
