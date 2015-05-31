<div class="mobile-header">
<div class="mobile_wrapper">
		<?php echo $this->Html->link($this->Html->image('rslogo.png', array('id' => 'mobile_logo')), '/', array('escape' => false)); ?>
		<div class="full_site">
			<?php echo $this->Html->link(h('Full Site'),array('controller' => 'Users', 'action' => 'visitFullSite','full_base' => true),array('class'=>''));?>&nbsp; | &nbsp;
			<?php echo $this->Html->link(h('Logout'),array('controller' => 'Users', 'action' => 'logout','full_base' => true),array('class'=>''));?>
    
		</div><!-- .full_site -->
		
    
    <div class="clear"></div>
</div><!-- .mobile_wrapper -->
</div><!-- .mobile-header -->

<div class="mobile-body pay-rent-mobile">
	<div class="mobile_wrapper">
	  <?php 
      if($user['type'] == USER_TYPE_MANAGER): ?><br>
      
      
      <?php //Resident
      else: ?>
          <?php 
            $balance_due =  floatval($billingcycle['Billing']['rent_due']);
            foreach($billingcycle['Payment'] as $payment):
              $balance_due = floatval($balance_due) - floatval($payment['amount']);
            endforeach; 
            $balance = $this->Number->currency($balance_due, 'USD', array('before'=>''));
           ?>
          <div id='flash-container'><?php echo $this->Session->flash(); ?></div>
          <strong>Current Balance: <?php echo $balance; ?></strong><br>
          <?php 
          echo $this->Form->create('Payment',array('controller'=>'Payments','action'=>'payrent'));
          echo $this->Form->hidden('unit_id',array('value'=>$unit['Unit']['id'])); 
          echo $this->Form->hidden('billing_id',array('value'=>$billingcycle['Billing']['id']));

          ?>

              <div class="billing_cycle_mobile">
              	<em>Enter Payment Amount</em>
              	<div class="clear"></div>
              	<div class="balance_block">
              		<div class="dollar_sign">
              			$
              		</div><!-- .dollar_sign -->
              		<div class="amount_input">
              			<?php echo $this->Form->input('Payment.amount', array('label' => false, 'value' => ltrim($balance,'$'), 'class'=>'pay_amount_mobile','div'=>false,'id'=>'payment_amount')); ?>
              		</div><!-- .balance_block -->
              	</div><!-- .balance_block -->
              	<div class="clear"></div>
              	<?php 
              	  if($billingcycle['Billing']['status'] == 'late'){
                	  echo '<div class="due_in late_mobile">'.$this->Html->image('bkg-flag.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'LATE</div>';
              	  } elseif($billingcycle['Billing']['status'] == 'due'){
                	  echo '<div class="due_in due_mobile">'.$this->Html->image('bkg-flag.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'DUE TODAY</div>';
              	  } else{
                    
                    $diff = abs(strtotime(date('Y/m/d')) - strtotime($billingcycle['Billing']['billing_end']));
                    
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                	  echo '<div class="due_in unpaid_mobile">'.$this->Html->image('bkg-flag.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'DUE IN '.$days;
                	  if($days>1)
                	    echo ' DAYS</div>';
                	  else
                	    echo ' DAY</div>';
              	  }
              	 ?>
              </div><!-- .billing_cycle_mobile -->
              <div class="billing_cycle_mobile">
              	<em>Choose Your Method of Payment</em>
              	<div class="clear"></div>
              	<div class="balance_block">
              		<div class="payment_method_mobile">
              			<?php 
              			//$payment_methods
                      $payment_options = array();
                      foreach($payment_methods as $payment_method):
                      if($payment_method['PaymentMethod']['type'] == 'CC'):
                          $payment_options[$payment_method['PaymentMethod']['vault_id']]= 'Card Ending In: '. $payment_method['PaymentMethod']['card_num'];                   
                      else: 
                          $payment_options[$payment_method['PaymentMethod']['vault_id']]= $payment_method['PaymentMethod']['bank_name'] . ' - ' . $payment_method['PaymentMethod']['account_num'];   
                    
                      endif; 
                      endforeach;
                      echo $this->Form->input('Payment.vault_id', array('type'=>'select','options'=>$payment_options,'label'=>false,'div'=>false,'class'=>'payment_select','id'=>'payment_select')); 
              			 ?>
              		</div><!-- .balance_block -->
              	</div><!-- .balance_block -->
              	<div class="clear"></div>
                  <div class="note_new_pay">To add a new payment method, <?php echo $this->Html->link(h('visit our full site'),array('controller' => 'Users', 'action' => 'myaccount','add_bank','full_base' => true),array('class'=>'go_to_full'));?></div>
                </div><!-- .billing_cycle_mobile -->
              <div class="clear"></div>
              <?php 
            echo $this->Form->submit(
                __('Submit Payment'), 
                array('class' => 'flat_green submit_payment_button', 'title' => 'Pay Now','id'=>'pay_now_click','onClick'=>'return validate();')
            );
            echo $this->Form->end(); ?>
           
      <?php endif; ?>
	  
	</div><!-- .mobile_wrapper -->
</div><!-- .mobile-body -->

<script>
var property_pays_ach_fee = <?php if($unit['Property']['prop_pays_ach_fee']) echo '1'; else echo '0'; ?>;
var property_pays_cc_fee = <?php if($unit['Property']['prop_pays_cc_fee']) echo '1'; else echo '0'; ?>;

function validate(){
  
	$amount = jQuery('#payment_amount').val();
	$payment = jQuery('#payment_select').val();

	if($amount != '' && $amount != 0){	  
  	  $payment_label = jQuery('#payment_select option:selected').text();
  	  if($payment_label.indexOf("Card Ending In: ") >= 0){
    	  //Credit Card Payment
    	  if(property_pays_cc_fee == 0)
    	    $transaction_fee = parseFloat($amount) * .0275;
    	  else 
    	    $transaction_fee = 0;
  	  } else {
    	  //Bank Payment
    	  if(property_pays_ach_fee == 0)
    	    $transaction_fee = 3.95;
    	  else 
    	    $transaction_fee = 0;
  	  }
  	  $pay_total = parseFloat($amount) + parseFloat($transaction_fee.toFixed(2));  	  
  	  return confirm("Please confirm your payment of $"+$amount+". The transaction fee for this payment is $"+$transaction_fee.toFixed(2)+".");
	  
	} else {
  	e.preventDefault();
  	alert('Please enter a payment amount.');
  	return false;
	}
};
</script>