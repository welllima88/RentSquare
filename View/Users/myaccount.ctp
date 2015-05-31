<?php if(!isset($section) || $section == '') $section = 'personal_info'; ?>
<div class="myaccount_left">
    <h2><?php echo $user['first_name'] .' '.$user['last_name']; ?></h2>
    <ul id="my_account_links">
      <li <?php if($section == 'personal_info') echo 'class="current"'; ?>><a id="personal_info" href="#personal_info" style="display: block;">Personal Information</a></li>
      <li <?php if($section == 'password') echo 'class="current"'; ?>><a id="password" href="#password" style="display: block;">Password</a></li>
      <?php if ($user['type'] == USER_TYPE_TENANT ): ?>
        <li <?php if($section == 'payment_methods') echo 'class="current"'; ?>><a id="payment_methods" href="#payment_methods" style="display: block;">Payment Methods</a></li>
      <?php endif; ?>
      <?php if ($user['type'] == USER_TYPE_MANAGER ): ?>
        <li <?php if($section == 'transaction_fees') echo 'class="current"'; ?>><a id="transaction_fees" href="#transaction_fees" style="display: block;">Transaction Fees</a></li>
        <li <?php if($section == 'tenant_billing  ') echo 'class="current"'; ?> id="li_tb"><a id="tenant_billing" href="#tenant_billing" style="display: block;">Tenant Billing Settings</a></li>
      <?php endif; ?>
      <li><a id="notifications" href="#notifications" style="display: block;">Notifications</a></li>
      <li><a id="delete" href="#delete" style="display: block;">Delete My Account</a></li>
    </ul>
</div><!-- .myaccount_left -->
<div class="myaccount_right">

    <div class="personal_info_content <?php if($section != 'personal_info') echo 'hide '; ?>my_account_content">
    	<h1 class="ma_title">Personal Information</h1>
    	<?php
    		echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'maupdatepersonal'));
    		echo '<div class="row-fluid">';
    		echo $this->Form->input('User.first_name', array('div'=>array('class'=>'span6'),'class'=>'validate[required]'));
    		echo $this->Form->input('User.last_name', array('div'=>array('class'=>'span6'),'class'=>'validate[required]'));
    		echo '</div>';
    		echo $this->Form->input('User.email', array('class'=>'validate[required,custom[email]]'));
    		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user['id']));
    		echo '<br>';
    		echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success','escape' => false ));
    		echo $this->Form->end();
    		
      ?>
    </div><!-- .personal_info_content -->
    <div class="password_content  <?php if($section != 'password') echo 'hide '; ?> my_account_content">
      <h1 class="ma_title">Password Reset</h1>
    	<?php 
    	   echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'maupdatepassword'));
    	   //echo $this->Form->input('User.old_password', array('label'=>'Old Password'));
    	   echo '<div class="row-fluid">';
    	   echo $this->Form->input('User.password', array('value'=>'','label'=>'New Password', 'div'=>array('class'=>'span6'),'id' => 'signup_password','class'=>'validate[required,minSize[6]]'));
    	   echo $this->Form->input('User.confirm_password', array('type' => 'password','div'=>array('label'=>'Confirm New Password','class'=>'span6'),'class'=>'pass_equal validate[required,minSize[6],equals[signup_password]]'));
    	   echo '</div/>';
    		 echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user['id']));
    		 echo '<br>';
    		
        	
        	
        	
        	
    		 echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success','escape' => false ));
    		echo $this->Form->end();
    	 ?>
    </div><!-- .password_content -->
    <?php if ($user['type'] == USER_TYPE_TENANT ): ?>
    <div class="payment_methods_content  <?php if($section != 'payment_methods') echo 'hide '; ?> my_account_content">
    	<h1 class="ma_title">Payment Methods</h1>
    	<ol class="card-list group">
        <li class="card add">
          <label class="trigger-first">
             <?php

            echo $this->Html->link('+ New Bank Account', array('controller' => 'PaymentMethods', 'action' => 'add_bank'), array('class' => 'main-nav-item'));
            echo '<br><br>';
            echo $this->Html->link('+ New Credit Card', array('controller' => 'PaymentMethods', 'action' => 'add_cc'), array('class' => 'main-nav-item'));
            ?>
          </label>
        </li>
      	
        <?php 
        foreach($payment_methods as $payment_method): 
        if($payment_method['PaymentMethod']['type'] == 'CC'):?>
            <li class="card">
            <label class="trigger">
              <?php echo '<strong>'.$payment_method['PaymentMethod']['description'] .'</strong><br>'; ?>
              <?php echo $payment_method['PaymentMethod']['first_name'] . ' ' . $payment_method['PaymentMethod']['last_name']; ?><br>
              <span class="card-format">Card Ending In: </span> <?php echo $payment_method['PaymentMethod']['card_num']; ?>
              <br>
              
            </label>
            <div class="pane">
              <?php echo $this->Html->link('<i class="icon-remove"></i>', '#delete_pm_modal_'.$payment_method['PaymentMethod']['id'], array('class' => 'delete_pm', 'id' => '#delete_pm_modal_'.$payment_method['PaymentMethod']['id'], 'role'=>'button', 'data-toggle' => 'modal', 'title'=>'Delete Payment Method', 'escape' => false)); ?>
              
            </div>
            <!-- Add Delte Payment Method Popup Form -->
            <?php echo $this->element('payment_method_delete',array('payment_method_id'=>$payment_method['PaymentMethod']['id'],'type'=>'CC','acc_number'=>$payment_method['PaymentMethod']['card_num'])); ?>

          </li>
        <?php else: ?>
          <li class="card bank">
            <label class="trigger">
              <?php echo '<strong>'.$payment_method['PaymentMethod']['description'] .'</strong><br>'; ?>
              <?php echo $payment_method['PaymentMethod']['first_name'] . ' ' . $payment_method['PaymentMethod']['last_name']; ?><br>
              <span class="card-format"></span> <?php echo $payment_method['PaymentMethod']['bank_name']; ?>
               - <?php echo $payment_method['PaymentMethod']['account_num']; ?>
              <br>
              
            </label>
            <div class="pane">                  
              <?php echo $this->Html->link('<i class="icon-remove"></i>', '#delete_pm_modal_'.$payment_method['PaymentMethod']['id'], array('class' => 'delete_pm', 'id' => '#delete_pm_modal_'.$payment_method['PaymentMethod']['id'], 'role'=>'button', 'data-toggle' => 'modal', 'title'=>'Delete Payment Method', 'escape' => false)); ?>
            </div>
            <!-- Add Delte Payment Method Popup Form -->            
            <?php echo $this->element('payment_method_delete',array('payment_method_id'=>$payment_method['PaymentMethod']['id'],'type'=>'Bank','acc_number'=>$payment_method['PaymentMethod']['account_num'])); ?>

          </li>
        <?php endif; ?>
          
                        
        <?php endforeach; ?>
          
        
      </ol>
      <div class="clear"></div><br>
    </div><!-- .payment_methods_content -->
    <?php endif; ?>
    
    <?php if ($user['type'] == USER_TYPE_MANAGER ): ?>
    <div class="transaction_fees_content  <?php if($section != 'transaction_fees') echo 'hide '; ?> my_account_content">
    	<h1 class="ma_title">Transaction Fees</h1>
      Select who will pay the transaction fee for  <?php echo $curProp['name']; ?>:<br><br>
      <?php echo $this->Form->create('Property', array('controller' => 'Property', 'action' => 'maupdatetransfee')); 
      	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $property['Property']['id']));
    	?>
      ACH Transactions: <?php
      echo $this->Form->input('Property.prop_pays_ach_fee', array('type'=>'radio','options'=>array('Resident','Property'),'legend'=>false,'class'=>'validate[required]','value'=>$property['Property']['prop_pays_ach_fee']));
      ?><br>
      Card Transactions:<?php
      echo $this->Form->input('Property.prop_pays_cc_fee', array('type'=>'radio','options'=>array('Resident','Property'),'legend'=>false,'class'=>'validate[required]','value'=>$property['Property']['prop_pays_cc_fee']));
      ?>
      <br><br>
      <?php echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success','escape' => false ));
    		echo $this->Form->end(); ?>
    </div><!-- .bank_account_content -->
    
    <div id="tenant_billing_div" class="tenant_billing_content  <?php if($section != 'tenant_billing') echo 'hide '; ?> my_account_content">
    	<h1 class="ma_title">Tenant Billing for <?php echo $curProp['name']; ?></h1>
    	<?php echo $this->Form->create('Property', array('controller' => 'Property', 'action' => 'maupdatetenantbilling')); 
      	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $property['Property']['id']));
    	?>
    	<div class="row-fluid">
    		<div class="span3">
    			<strong>Invoices</strong>
    		</div><!-- .span4 -->
    		<div class="span9 tb_section">
    			Residents will be invoiced for their rent 
      <?php echo $this->Form->input('Property.invoice_day', array('type'=>'select', 'options'=>array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'), 'label'=>false,'class'=>'confirm','div'=>'','default'=>$property['Property']['invoice_day'])); ?> 
      days before rent due date.
    		</div><!-- .span8 -->
    	</div><!-- .row -->
      <div class="row-fluid">
      	<div class="span3">
      		<strong>Rent Reminder</strong>
      	</div><!-- .span4 -->
      	<div class="span9 tb_section">
      		<?php 
          //(Checkbox) If not paid, send reminder (dropdown-XX) days before rent is due-default same day
        	echo $this->Form->input('Property.before_due_reminder', array('type' => 'checkbox', 'label' => '','class'=>'confirm', 'checked' => $property['Property']['before_due_reminder'],'div'=>'checkbox_input'));?>
          A courtesy rent reminder will be sent to residents  
          <?php 
          echo $this->Form->input('Property.before_due_days', array('type'=>'select', 'options'=>array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'), 'label'=>false,'class'=>'confirm','div'=>'','default'=>$property['Property']['before_due_days'])); ?> 
         days before the rent due if it has not been paid already
      	</div><!-- .span8 -->
      </div><!-- .row-fluid -->
      <div class="clear"></div>
    	
     <div class="clear"></div>
     <div class="row-fluid">
     	 <div class="span3">
     	 	 <strong>Late Rent</strong>
     	 </div><!-- .span4 -->
     	 <div class="span9 tb_section">
     	 	<?php 
         //(Checkbox) Automatic assign late fee to resident (if selected entry box will appear for amount of late fee to be applied automatically)-default unchecked
         //if checked, gray out send late fee on payments tab with message explaining why its grayed out and link to my account section    	echo $this->Form->input('Property.before_due_reminder', array('type' => 'checkbox', 'label' => '', 'checked' => $property['Property']['before_due_reminder'],'div'=>'checkbox_input'));
        echo $this->Form->input('Property.auto_late_fee', array('type' => 'checkbox', 'label' => '','class'=>'confirm', 'checked' => $property['Property']['auto_late_fee'],'div'=>'checkbox_input'));?>
        Automatically charge late fee to resident if rent is past due (please specify late fee below)
        <br><br>
        <div class="disable-text">
        <span class="select_text" style="clear:left; margin-left:20px;">Late Fee Amount</span>
  
        <?php 
         echo '<div class="form_input">';
            	echo '<div class="input-prepend"><span class="add-on" style="float:left;"><i class="icon">$</i></span>';
            	echo $this->Form->input('Property.auto_late_fee_amt', array('type'=>'text','label'=>false,'class'=>'floatLeft late_fee_amt confirm', 'div'=>'false','value'=>$property['Property']['auto_late_fee_amt'],'pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01'));
            	echo '</div>';
          echo '</div><!-- .form_input -->';
          
         ?>
         <div class="clear"><br><br></div>

     	 	Residents will be charged a late fee if the rent has not been paid 
        <?php 
        //Rent late (dropdown-XX) days after rent due date - default 3 days
        echo $this->Form->input('Property.day_rent_late', array('type'=>'select', 'options'=>array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'), 'label'=>'','class'=>'confirm','div'=>'','default'=>$property['Property']['day_rent_late'])); ?> 
       days after the rent due date
        </div><!-- disable-text -->
            	 </div><!-- .span8 -->
     </div><!-- .row-fluid -->
      
     
     <div class="clear"></div>
    
     

     <div class="clear"><br></div>
     <?php echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success','escape' => false ));
    		echo $this->Form->end(); ?>
    	
    </div><!-- .tenant_billing_content -->

    <!-- Modal for confirming unsaved changes when clicking away from tenant_billing to another internal link -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
<!--
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
-->
          <div class="modal-body">
            <p>You have not saved your changes. Are you sure you want to continue without saving? Please remain on this page and click Save if you would like to keep your changes.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-confirmleave" id="myacctmodaldismiss">Leave This Page</button>
            <button type="button" class="btn btn-confirmstay">Stay On This Page</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php endif; ?>
      
    <div class="notifications_content  <?php if($section != 'notifications') echo 'hide '; ?> my_account_content">
       <h1 class="ma_title">Notifications</h1>
    	 <?php
     
    		echo $this->Form->create('User', array('controller' => 'Users', 'action' => 'update'));
    		
    		if ($user['type'] == USER_TYPE_TENANT ):
    		//Resident
    		  echo '<h4>Directory Section</h4>';
    		  echo $this->Form->input('User.list_in_directory', array('type' => 'checkbox', 'label' => 'I would like my RentSquare e-mail to be added to the building directory.', 'checked' => $user['list_in_directory']));
    		  echo '<h4>E-mail</h4>';
    		  echo $this->Form->input('User.email_for_messages', array('type' => 'checkbox', 'label' => 'E-mail when I receive a message on RentSquare.', 'checked' => $user['email_for_messages']));
    		  echo $this->Form->input('User.email_for_rent', array('type' => 'checkbox', 'label' => 'E-mail when rent is due.', 'checked' => $user['email_for_rent']));
    		  echo $this->Form->input('User.email_for_maintenance', array('type' => 'checkbox', 'label' => 'E-mail for maintenance updates.', 'checked' => $user['email_for_maintenance']));
    		  //  (Checkbox) E-mail confirmation/receipt when payment is received
    		  echo $this->Form->input('User.email_payment_confirmation', array('type' => 'checkbox', 'label' => 'E-mail confirmation/receipt when payment is received.', 'checked' => $user['email_payment_confirmation']));
    		  //  (Checkbox) E-mail confirmationwhen late fee assessed
    		  echo $this->Form->input('User.email_latefee_assessed', array('type' => 'checkbox', 'label' => 'E-mail me if my account is assessed a late fee.', 'checked' => $user['email_latefee_assessed']));
    		  //  (Checkbox) I would like to receive the RentSquare newsletter and marketing
    		  echo $this->Form->input('User.email_newsletter', array('type' => 'checkbox', 'label' => 'I would like to receive the RentSquare newsletter and marketing.', 'checked' => $user['email_newsletter']));
    		else:
    		//Property Manager
    		echo $this->Form->input('User.email_for_messages', array('type' => 'checkbox', 'label' => 'E-mail when I receive a message on RentSquare.', 'checked' => $user['email_for_messages']));
    		// (Checkbox) E-mail when a payment is made (default unchecked)
    		echo $this->Form->input('User.email_payment_made', array('type' => 'checkbox', 'label' => 'E-mail when a payment is made.', 'checked' => $user['email_payment_made']));
        // (Checkbox) E-mail for new maintenance requests.
        echo $this->Form->input('User.email_new_maint', array('type' => 'checkbox', 'label' => 'E-mail for new maintenance requests.', 'checked' => $user['email_new_maint']));
        // (Checkbox) E-mail summary of residents who are late on their payments. (one time notification)
        echo $this->Form->input('User.email_late_payments', array('type' => 'checkbox', 'label' => 'E-mail summary of residents who are late on their payments.', 'checked' => $user['email_late_payments']));
        // (Checkbox) E-mail when a tenant overdraft/NSF occurs (i.e. tenant bounces a check)
        echo $this->Form->input('User.email_overdraft', array('type' => 'checkbox', 'label' => 'E-mail when a tenant overdraft/NSF occurs.', 'checked' => $user['email_overdraft']));
        //  (Checkbox) I would like to receive the RentSquare newsletter and marketing
    		  echo $this->Form->input('User.email_newsletter', array('type' => 'checkbox', 'label' => 'I would like to receive the RentSquare newsletter and marketing.', 'checked' => $user['email_newsletter']));
    		endif;
    	  echo '<br>';
    		
    		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $user['id']));
    		echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success','escape' => false ));
    		echo $this->Form->end();
    	?>
    </div><!-- .notifications_content -->
      
    <div class="delete_content  <?php if($section != 'delete') echo 'hide '; ?> my_account_content">
       <h1 class="ma_title">Delete My Account</h1>
                <?php if ($user['type'] == USER_TYPE_TENANT ) { ?>
                <?php           
                  echo "<button id=\"delete_tenant\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i>&nbsp;Delete My Account</button>";
               
                  // Are you sure modal...
                  echo $this->element('tenant_delete',array('tenant_id'=>$user['id'],'first_name'=>$user['first_name'],'unit_id'=>$user['unit_id']));
                ?>
                <?php } ?>
                <?php if ($user['type'] == USER_TYPE_MANAGER ) {?>
                To delete your account please e-mail customer service at <a href="mailto:support@rentsquare.co">support@rentsquare.co</a>
                <?php } ?>
    </div><!-- .delete_content -->
    
</div><!-- .myaccount_right -->
<span id="whichlink" class="" style="display: none;"></span>
<script>
var shouldConfirm = false;

var $myacctmodal = $('#myacctmodaldismiss');
$myacctmodal.on('click', function () {
    $myacctmodal.hide();
    var intlink = $('#whichlink').attr('class');
    window.location='http://rentsquaredev.com/Users/myaccount/' + intlink;
    return false;
});

window.onbeforeunload = function() {
   if(shouldConfirm) {
       return "You have not saved your changes. Are you sure you want to continue without saving? Please remain on this page and click Save if you would like to keep your changes.";
   }
}
jQuery('.confirm').change(function(){
  shouldConfirm = true;
});

jQuery(document).ready( 
    
    function () { 
        jQuery("a:not(#tenant_billing')").click(function(){
           if(shouldConfirm) {
               // Doesn't work as buttons end up with inverse functionality
               //window.location='http://rentsquaredev.com/Users/myaccount/tenant_billing';

               // Doesn't work as bind doesn't initiate window right away (on click)
               //$(window).bind('beforeunload', function() {
               //    return "You have not saved your changes. Are you sure you want to continue without saving? Please remain on this page and click Save if you would like to keep your changes.";
               //});
               // Set which link was clicked as we need info later
               var intlinkclick = $(this).attr('id');
               $('#whichlink').removeClass();
               $('#whichlink').addClass(intlinkclick);
               $('#confirmModal').modal('show');
           }
        });

    // When they do click save, we want it to work
    $('.btn-success').click(function(){
        shouldConfirm = false;
    });

    // When they say its ok to ignore changes
    $('.btn-confirmleave').click(function(e){
        shouldConfirm = false;
        $('#confirmModal').modal('hide');
    });

    // When they don't want to leave changes unsaved after clicking on an internal link
    $('.btn-confirmstay').click(function(){
        $('#confirmModal').modal('hide');
        $('#my_account_links').children('.current').removeClass('current').siblings('#li_tb').addClass('current');
        $('.personal_info_content').css({ 'display': "none" });
        $('.password_content').css({ 'display': "none" });
        $('.transaction_fees_content').css({ 'display': "none" });
        $('.notifications_content').css({ 'display': "none" });
        $('.delete_content').css({ 'display': "none" });
        $('#tenant_billing_div').show();
        //window.location.hash='#tenant_billing_div';
    });

    // Deactivate user and logoff
    $('#delete_tenant').click(function(){
       $('#tenantDelete').modal('show');
    });

   jQuery('#PropertyAutoLateFeeAmt').on('change',function(e1){
            jQuery(this).val(jQuery(this).val().replace(/,/g,''));
            return true;
   });
});

</script>
