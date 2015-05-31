<?php $data = $this->request->data; ?>       
    <div class="cur_balance">
    	<?php if(!isset($data['AutoPayment']['id'])) echo 'Setup ';?>Automatic Payments
    </div><!-- .balance --> 
    <div class="clear"><br></div>

    <div class="white_content make_payments">
    <?php if(count($payment_methods) == 0): ?>
      Please add a payment method before setting up automatic payments. 
      <?php echo $this->Html->link(h('Click Here to add a New Payment Method'), 
                                array('controller' => 'users', 'action' => 'myaccount', 'payment_methods','full_base' => true),
                                array('class'=>'add_pay_btn')
                            ); ?>
      <br><br><br><br><br><br>
    <?php else: ?>
       <div class="make_pay">
        <?php  if(isset($data['AutoPayment']['id'])){  ?>
       	   Auto Payment Summary
        <?php } else { ?>
       	   Automate your rental payments
       	<?php } ?>
       </div><!-- .make_pay --><br>
       
        <?php  if(isset($data['AutoPayment']['id'])){  
       	   $autopay = array('off','on');
       	   if($data['AutoPayment']['active']){
       	   ?>
       	     <div class="payment_box_auto_on">

       	     <strong>YOU ARE CURRENTLY SENDING AN AUTOMATIC PAYMENT OF: </strong>
       	     <br> 
       	     <div class="auto_pay_amount">
       	     	<?php echo $this->Number->currency( $data['AutoPayment']['amount'] ,'USD'); ?>
       	     </div><!-- .auto_pay_amount -->
       	     
       	     From <strong><?php echo $data['AutoPayment']['auto_start']; ?></strong> until <strong><?php echo $data['AutoPayment']['auto_end']; ?></strong>
       	      <br>
       	      <a href="#edit_auto_payment" id="edit_auto_pay" class="edit_auto_pay_on">Edit Auto Payment</a>
       	     </div>
       	     
       	   <?php } ?>
       	   <div class="auto_pay_switch">
       	   
         	   Auto payments are currently <?php echo $autopay[$data['AutoPayment']['active']]; ?><br> <br>                                                                                                   
         	   <div id="auto_on_off" class="btn-group"  data-toggle="buttons-radio">
              <button type="button" class="btn <?php if($autopay[$data['AutoPayment']['active']] == "on") echo 'active'; ?>">ON</button>
              <button type="button" class="btn  <?php if($autopay[$data['AutoPayment']['active']] == "off") echo 'active'; ?>">OFF</button>
            </div>
       	     <?php if(!$data['AutoPayment']['active']): ?>
       	     <br><br><a href="#edit_auto_payment" id="edit_auto_pay"><i class="icon-pencil"></i> Edit Auto Payment</a>
       	     <?php endif; ?>
       	     
          <br><br>
       	   
       	   </div><!-- auto_pay_switch -->
        <?php } ?>
        
       	
       	<div class="clear"><br></div>
        <div id="auto_payment_form" style="<?php  if(isset($data['AutoPayment']['id'])) echo 'display:none';  ?>">
        <?php
       	     if(isset($data['AutoPayment']['active']) && $data['AutoPayment']['active']){ ?>
                <div class="make_pay">
                	<br>Edit Auto Payment<br><br>
                </div><!-- .make_pay -->
            	  <div class="clear"></div>
       	  <?php   }?>
        <?php  echo $this->Form->create('AutoPayment',array('controller'=>'AutoPayments','action'=>'add')); ?>
        <div class="payment_box">
          <?php
          echo $this->Form->hidden('AutoPayment.id');
          echo '<div class="form_input">';
            	echo '<label for="amount">How much would you like to pay each month?</label><div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>';
            	echo $this->Form->input('amount', array('type'=>'text','class'=>'dollar_input validate[required,custom[number]]','div'=>false,'label'=>false,'id'=>'payment_amount'));
            	echo '</div>';
          echo '</div><!-- .form_input -->'; 
          ?>
        </div><!-- .payment_box -->
        <div class="payment_method">
        	 <span class="label_span">Choose Your Method of payment</span><br><br>
          <?php 
          $payment_options = array();
          foreach($payment_methods as $payment_method):
          if($payment_method['PaymentMethod']['type'] == 'CC'):
              $payment_options[$payment_method['PaymentMethod']['vault_id']]= 'Credit Card Ending In: '. $payment_method['PaymentMethod']['card_num'];                   
          else: 
              $payment_options[$payment_method['PaymentMethod']['vault_id']]= $payment_method['PaymentMethod']['bank_name'] . ' - ' . $payment_method['PaymentMethod']['account_num'];   
        
          endif; 
          endforeach;
          echo $this->Form->input('vault_id', array('type'=>'radio','options'=>$payment_options,'legend'=>false,'separator'=>'','div'=>false,'class'=>'validate[required]')); 
          echo $this->Html->image('cc_image.jpg', array('alt' => '','class'=>'cc_img'));
          echo $this->Html->link(h('Add New Payment Method'), 
                                array('controller' => 'PaymentMethods', 'action' => 'add_bank', 'full_base' => true),
                                array('class'=>'add_pay_btn')
                            );?>
        </div><!-- .payment_method -->
        <div class="payment_duration_box">
           <span class="label_span">Choose the duration of your automatic payments</span>
           <div class="auto_from_to">
            <?php echo $this->Form->input('auto_start', array('type'=>'text', 'label' => 'From:','placeholder' => 'mm/dd/yyyy', 'class' => 'datepicker validate[required]')); ?>
            <div class="clear"></div>
            <?php echo $this->Form->input('auto_end', array('type'=>'text', 'label' => 'To:','placeholder' => 'mm/dd/yyyy', 'class' => 'datepicker validate[required]')); ?>
           </div><!-- auto_from_to -->
        </div><!-- .payment_duration_box -->
        
    <div class="clear"><br></div>
    <div class="auto_two_thirds">
    	<h3>RentSquare Tip!</h3>

      To revoke a payment please contact our admin at admin@rentsquare.com within 48 hours.
    </div><!-- .two_thirds -->  
    <div class="auto_one_third">
    	<?php
    if(isset($data['AutoPayment']['id'])) 
	    echo $this->Form->submit(
        __('Update Auto Payment'), 
        array('class' => 'flat_green pay_now_button', 'title' => 'Pay Now')
    ); 
	  else
	  echo $this->Form->submit(
        __('Save Auto Payment'), 
        array('class' => 'flat_green pay_now_button', 'title' => 'Pay Now')
    );
    echo $this->Form->end(); ?>
    </div><!-- .one_third --> 
    </div><!-- #auto_payment_form -->
    <div class="clear"><br></div>
    <?php endif; ?>
    </div><!-- .white_content -->
   <script>
      jQuery('#payment_amount').blur(function(){
        jQuery(this).val(jQuery(this).val().replace(',',''));
      });

      jQuery(function($){
      	$('.datepicker').datepicker({
        	changeMonth: true,
          changeYear: true
      	});
      	$('#edit_auto_pay').click(function(e){
      		e.preventDefault();
      		$('#auto_payment_form').slideToggle();
      	});
      	
      	$('#auto_on_off button').not('active').click(function(e){
      	  window.location.href = "/AutoPayments/toggleActivation/<?php if(isset($data['AutoPayment']['id'])) echo $data['AutoPayment']['id']; ?>";
      	});
      });

   </script>
