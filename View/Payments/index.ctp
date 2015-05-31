<script> var myPaymentMethods = new Array();</script>
<?php 
if($user['type'] == USER_TYPE_MANAGER): ?><br>

<?php //Resident
      else: 
       //Find Current Balance
       $total_due = 0;
       $details = '';
       $billing_ids = array('0'=>'Total Balance');
       foreach($Billings as $billingcycle):
          $money_due = 0;
          $money_due = floatval($money_due)  + floatval($billingcycle['Billing']['rent_due']);
          foreach($billingcycle['Payment'] as $payment):
            $money_due = floatval($money_due) - floatval($payment['amount']);
          endforeach;
          $billing_ids[$billingcycle['Billing']['id']]='$'.$money_due.' due on '.date('M d',strtotime($billingcycle['Billing']['billing_end']));
          $details .= '<div class="payment_details_wrapper"><div class="payment_details"><div class="pay_summary"><div class="pay_title">';
          if($billingcycle['Billing']['type'] == 'One Time Fee'){
            $details .= '<strong>ONE TIME FEE</strong> <em>due:</em> <strong>'.date('m/d/y',strtotime($billingcycle['Billing']['billing_end'])).'</strong>';
          }
          else{
            $details .= '<strong>SUMMARY</strong> <em>for the period:</em> <strong>'.date('m/d/y',strtotime($billingcycle['Billing']['billing_end'])).' - '.date('m/d/y',strtotime($billingcycle['Billing']['rent_period'])).'</strong>';
          }
          
          $details .= '</div> <em>Current Balance</em><br><div class="pay_money_due"><span>'.$this->Number->currency( $money_due ,'USD').'</span> out of '. $this->Number->currency( $billingcycle['Billing']['rent_due'] ,'USD') .'</div>';
            	  if($billingcycle['Billing']['status'] == 'late'){
              	  $details .= '<div class="due_in pay_late">'.$this->Html->image('bkg-flag-black.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'LATE</div>';
            	  } elseif($billingcycle['Billing']['status'] == 'due'){
              	  $details .= '<div class="due_in due_mobile">'.$this->Html->image('bkg-flag-black.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'DUE TODAY</div>';
            	  } else{
                  
                  $diff = abs(strtotime(date('Y/m/d')) - strtotime($billingcycle['Billing']['billing_end']));
                  
                  $years = floor($diff / (365*60*60*24));
                  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

              	  $details .= '<div class="due_in unpaid_mobile">'.$this->Html->image('bkg-flag-black.png', array('alt' => '','width'=>'18','height'=>'18','class'=>'flag_icon')).'DUE IN '.$days;
              	  if($days>1)
              	    $details .= ' DAYS</div>';
              	  else
              	    $details .= ' DAY</div>';
            	  }
              	 
                $details .='<br></div><!-- .pay_summary --><div class="pay_breakdown"><div class="pay_title pay-left"><strong>BREAKDOWN</strong></div>';
          
          foreach($billingcycle['BillingFee'] as $billing_fee):
              $details .= '<div class="pay-left pay-fees"><span class="pay_fee_name">' .$billing_fee['name'] .'</span>$'.$billing_fee['amount'] . '</div>';
          endforeach;
          foreach($billingcycle['Payment'] as $payment):
            $details .= '<div class="pay-left pay-fees"><span class="pay_fee_name">' .$payment['User']['first_name'] .' ' . $payment['User']['last_name']. '</span>-'. $this->Number->currency( $payment['amount'] ,'USD',array('after'=>false))  . '</div>';
          endforeach;
          $total_due = floatval($total_due) + floatval($money_due);
          $details .= '<div class="pay-left pay_tally"><span class="pay_fee_name"><strong>BALANCE DUE</strong></span>'. $this->Number->currency( $money_due ,'USD') .'</div>';
          $details .= '</div><div class="clear"></div></div><!-- payment_details --></div><!-- payment_details_wrapper -->';
         endforeach;
         $billing_ids[0]='Total Balance ('.$this->Number->currency( $total_due ,"USD").')';
       ?>
       
    <div class="cur_balance">
    	Current Balance: <span class="cur_total"><?php echo $this->Number->currency( $total_due ,'USD'); ?></span>
    	<a href="#" id="pay_details">Details<span class="caret"></span></a>
    </div><!-- .balance --> 
    <div id="balance_details" style="display:none;">
    	<?php echo $details; ?>
    </div><!-- .balance_details -->
     
    <div class="clear"><br></div>

    <div class="white_content make_payments">
       <div class="make_pay">
       	Make a payment today
       </div><!-- .make_pay --><br>
       <?php 
       if(isset($unit['Unit']['id'])):
         
        echo $this->Form->create('Payment',array('controller'=>'Payments','action'=>'payrent'));
        echo $this->Form->hidden('unit_id',array('value'=>$unit['Unit']['id'])); ?>
        <div class="payment_box">
          <?php
          echo $this->Form->input('billing_id',array('type'=>'select','options'=>$billing_ids,'label'=>'Make payment toward'));
          echo '<br>';
          echo '<div class="form_input">';
            	echo '<label for="amount">Choose payment amount</label><div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>';
            	echo $this->Form->input('amount', array('class'=>'dollar_input','div'=>false,'label'=>false,'type'=>'text','id'=>'payment_amount'));
            	echo '</div>';
          echo '</div><!-- .form_input -->'; 
          echo '<label for="pay_full" class="checkbox_label">';
          echo $this->Form->checkbox('payfull', array('hiddenField' => false,'id'=>'pay_full','data-total'=>$total_due));
          echo 'Pay Full <span>'. $this->Number->currency( $total_due ,'USD').'</span> Due</label>';
          ?>
        </div><!-- .payment_box -->
        <div class="payment_method">
        	 <span class="label_span">Choose Your Method of payment</span><br><br>
          <?php 
          $payment_options = array();
          foreach($payment_methods as $payment_method):
          if($payment_method['PaymentMethod']['type'] == 'CC'):
              $payment_options[$payment_method['PaymentMethod']['vault_id']]= 'Credit Card Ending In: '. $payment_method['PaymentMethod']['card_num'];  
              echo '<script>myPaymentMethods['.$payment_method['PaymentMethod']['vault_id'].']= "Credit Card<br> Account #: ************'.$payment_method['PaymentMethod']['card_num'].'"</script>';                 
          else: 
              $payment_options[$payment_method['PaymentMethod']['vault_id']]= $payment_method['PaymentMethod']['bank_name'] . ' - ' . $payment_method['PaymentMethod']['account_num'];   
              echo '<script>myPaymentMethods['.$payment_method['PaymentMethod']['vault_id'].']= "'.$payment_method['PaymentMethod']['bank_name'].'<br> Routing #: '.$payment_method['PaymentMethod']['routing_number'].'<br> Account #: ****'.$payment_method['PaymentMethod']['account_num'].'"</script>';
          endif; 
          
          endforeach;
          echo $this->Form->input('vault_id', array('type'=>'radio','options'=>$payment_options,'legend'=>false,'separator'=>'','div'=>false,'class'=>'payment_select')); 
          echo $this->Html->image('cc_image.jpg', array('alt' => '','class'=>'cc_img'));
          echo $this->Html->link(h('Add New Payment Method'), 
                                array('controller' => 'PaymentMethods', 'action' => 'add_bank','full_base' => true),
                                array('class'=>'add_pay_btn')
                            );?>
        </div><!-- .payment_method -->
        <div class="pay_now_box">
        <a href="#payment_summary" role="button" class="flat_green pay_now_button" id="pay_now_click">Pay Now</a>
        <!-- Modal -->
        <div id="payment_summary" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="paySummary" aria-hidden="true">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <br>
            <h2>Confirm Payment</h2>
            <br>
            		<div class="cp_label">Payment amount:</div>
            		<div class="cp_value"><div id="pay_amt"></div><!-- .pay_amt --></div>
            		<div class="clear"></div>
            		<div class="cp_label">Convenience Fee:</div>
            		<div class="cp_value"><div id="pay_fee"></div><!-- #pay_fee --> </div>
            		<div class="clear"></div>
            		<div class="cp_label"><strong>Payment Total:</strong></div>
            		<div class="cp_value"><strong><div id="pay_total"></div><!-- #pay_total --></strong></div>
            		<div class="clear"><br></div>
            		<div class="cp_label">Payment Date:</div>
            		<div class="cp_value"><?php echo date('l, F d, Y'); ?></div>
            		<div class="clear"><br></div>
            		<div class="cp_label">User:</div>
            		<div class="cp_value"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></div>
            		<div class="clear"><br></div>
            		<div class="cp_label">Payment Method:<br>
              		<span>I authorize RentSquare<br>to debit my account</span>
            		</div>
            		<div class="cp_value"><div id="bank_confirm_info"></div></div>
            		<div class="clear"><br></div>
            		<br>
            
            <?php 
            echo $this->Form->submit(
                __('Submit Payment'), 
                array('class' => 'flat_green submit_payment_button', 'title' => 'Pay Now')
            );
            ?><br><br>
          </div><br>
        </div>
        
        	<?php
            echo $this->Form->end(); ?>
            
            <h3>RentSquare Tip!</h3>

            Don't worry about logging in to make a payment every month.  With automatic payments, RentSquare will automatically pay your rent every billing cycle!
          <?php else: ?>
              
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="35px" height="20px" viewBox="0 0 100 87.5" enable-background="new 0 0 100 87.5" xml:space="preserve">
            <polygon fill="#ef2222" points="12.5,87.5 43.75,87.5 43.75,62.5 56.25,62.5 56.25,87.5 87.5,87.5 87.5,50 100,50 50,0 0,50 12.5,50 "></polygon>
            </svg>
            	You are not currently assigned to a unit.
            	<a href="http://rentsquaredev.com/users/residentsearch/C%AC" style="color:#81c347">Click here to request a new unit!</a>  	 
            <?php endif; //if isset unit id ?>
        </div><!-- .pay_now_box -->
        
    <div class="clear"><br><br></div>
    </div><!-- .white_content -->
<?php endif; ?>
<script>
var property_pays_ach_fee = <?php if($unit['Property']['prop_pays_ach_fee']) echo '1'; else echo '0'; ?>;
var property_pays_cc_fee = <?php if($unit['Property']['prop_pays_cc_fee']) echo '1'; else echo '0'; ?>;
jQuery('#pay_full').click(function(e){
  if(this.checked)
  	jQuery('#payment_amount').val(jQuery(this).attr('data-total'));
});
jQuery('#pay_now_click').click(function(e){
	$amount = jQuery('#payment_amount').val();
	$payment = jQuery('.payment_select:checked');
	if($amount != '' && $amount != 0){ 
	  if($payment.length ==0 || $payment == null){
  	  e.preventDefault();
      alert('Please select a method of payment.');
      return false;
	  } else {
  	  $payment_label = $payment.next().html();
  	  if($payment_label.indexOf("Credit Card Ending In: ") >= 0){
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
  	  jQuery('#pay_amt').html('$'+parseFloat($amount).formatMoney(2, '.', ','));
  	  jQuery('#pay_fee').html('$'+parseFloat($transaction_fee).formatMoney(2, '.', ','));
  	  $pay_total = parseFloat($amount) + parseFloat($transaction_fee.toFixed(2));
  	  jQuery('#pay_total').html('$'+$pay_total.formatMoney(2, '.', ','));
  	  jQuery('#bank_confirm_info').html(myPaymentMethods[$payment.val()]);
      jQuery('#payment_summary').modal('show');
      return true;
	  }
	} else {
  	e.preventDefault();
  	alert('Please enter a payment amount.');
  	return false;
	}
});
jQuery('#pay_details').click(function(e){
	e.preventDefault();
	jQuery('#balance_details').slideToggle();
});
jQuery('#payment_amount').blur(function(){
  jQuery(this).val(jQuery(this).val().replace(',',''));
});
Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

jQuery(function(){
	//Set Cookies if exist on page load
  if($.cookie('rs_pay_toward')){
    jQuery('#PaymentBillingId').val($.cookie('rs_pay_toward'));
  }
  if($.cookie('rs_pay_amt')){
    jQuery('#payment_amount').val($.cookie('rs_pay_amt'));
  }
  //Clear cookies
  $.removeCookie('rs_pay_toward');
  $.removeCookie('rs_pay_amt');
  $(".payment_select:first").attr('checked', true);
  //Set onclick value
  jQuery('.add_pay_btn').click(function(e){
  	$.cookie('rs_pay_toward', jQuery('#PaymentBillingId').val());
  	$.cookie('rs_pay_amt', jQuery('#payment_amount').val());
  });
  
  jQuery('#PaymentBillingId').change(function(e){
    $money = jQuery('#PaymentBillingId option:selected').text().split(' ');
    if($money[0] == "Total"){
      jQuery('#payment_amount').val($money[2].replace('$','').replace('(','').replace(')','').replace(',',''));
    }else{
      jQuery('#payment_amount').val($money[0].replace('$',''));
    }
  });
  
  
  //vault_id
  $id = '';
  $id = getUrlVars()["id"];
  //set payment method
  if($id != ''){
    $('input[name="data[Payment][vault_id]"][value="'+ $id +'"]').prop('checked', true); 
  }  
  function getUrlVars()
  {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }

});

</script>