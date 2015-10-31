<script>
  function get_monthly_fee($num_units){
    //0 - 25 units - $25
    if($num_units <= 25){
      return <?php echo $MONTHLY_25_OR_LESS; ?>;
    }
    //26 - 50 units - $50
    if($num_units <= 50){
      return <?php echo $MONTHLY_26_TO_50; ?>;
    }
    //51 - 100 units - $75
    else if($num_units <= 100){
      return <?php echo $MONTHLY_51_TO_100 ; ?>;
    }
    //101 - 200 units - $125
    else if($num_units <= 200){
      return <?php echo $MONTHLY_101_TO_200; ?>;
    }
    //201 - 300 units - $175
    else if($num_units <= 300){
      return <?php echo $MONTHLY_201_TO_300; ?>;
    }
    //301 - 400 units - $225
    else if($num_units <= 400){
      return <?php echo $MONTHLY_301_TO_400; ?>;
    }
    //400++ units - $275
    else if($num_units > 400){
      return <?php echo $MONTHLY_OVER_400; ?>;
    }
    else{
      return 0;
    }
}
</script>
<style>
  .process_steps{display:block;}
</style>

  <!-- Create Before you get started dialog box for items needed during signup -->
  <div id="getStartedModal" class="modal hide fade pmsignupmodel" tabindex="-1" role="dialog" aria-labelledby="getStarted" aria-hidden="true">
  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h2 id="getStartedHeader">Before you get started...</h2>
    Please make sure you have the following materials readily available to register:
    <br><br>
    
    <ul class="getStatedList">
      <li>Building contact's social security number</li>
      <li>Property name and address</li>
      <!--<li>Ownership entity's legal name and tax ID number (EIN #)</li>-->
      <li>Ownership entity's legal name</li>
      <li>A bank account and routing number for handling transactions</li>
    </ul>
    <br>
    <?php echo $this->Html->image('bkg-password.png', array('alt' => 'Secure', 'style'=>'height: 12px;margin-top: -3px;')); ?> This information is required to verify your identity and allow you to accept electronic payments from residents. Your privacy is our number one priority and this information will not be shared. 
  </div>
  
  <div class="modal-footer">
    <button class="btn im-not-ready">I'm Not Ready</button>
    <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Get Started</button>
  </div>
  </div><!-- #gerStartedModal -->
  
  <!-- Create Before you get started dialog box for items needed during signup -->
  <div id="notReadyModal" class="modal hide fade pmsignupmodel" tabindex="-1" role="dialog" aria-labelledby="notReady" aria-hidden="true">
  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h2 id="getStartedHeader">We're standing by!</h2>
    Don't worry, we aren't going anywhere. We've made it easy for you to pick up right where you left off.  Just enter your email address and we'll send you a friendly reminder tomorrow.
    <br><br>
    
    <div class="enterEmail">
      <?php 
          echo $this->Form->create('User', array('action' => 'addSignupReminder'));
          echo $this->Form->input('SignupReminder.email', array('label' => 'Please enter your email address','placeholder' => 'Email Address'));
          echo $this->Form->button("Remind Me", array('class' => 'btn btn-success validate[email]','escape' => false )); 
          echo $this->Form->end();
       ?>
    
    </div>
  </div>
  <div class="modal-footer">
  </div>
  </div><!-- notReadyModal -->

<div id="form_wrapper">

  
<?php
  //Start Property Manager Sign Up Form
	echo $this->Form->create('User', array('action' => 'propertymanager'));
/*
                                               'inputDefaults' => array( 'error' => array(
                                                       'attributes' => array( 
                                                           'wrap' => 'div', 'class' => 'formError formErrorContent'
                                )))));
*/
?>
	
	<!-- *****************************************************************
	      Owner Personal Info Form 
	     ***************************************************************** -->
	
	<div id="pm_personal" class="pm_step step">
	  <div class="register_form">
      <div class="register_wrapper">
          <?php echo $this->Session->flash(); ?>
          <?php if(isset($error_messages)): 
            $i=0;
            foreach($error_messages as $error_message):
                echo 'Property '.$i.': ';
                echo $error_message['message'] .'<br>';
                $i++;
            endforeach; //foreach error_messages
          endif; ?>
          <h1 class="reg_title">
            Property Manager Sign Up - Personal Information
          </h1>
          <h2 class="reg_subtitle">Enter Your Personal Information</h2>
          <?php
          
        	echo '<div class="row-fluid">';
        	echo $this->Form->input('User.first_name', array('label' => 'First Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required]'));
        	echo $this->Form->input('User.last_name', array('label' => 'Last Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required]'));
        	echo '</div><!-- .row -->';
        	echo '<div class="row-fluid">';
        	echo $this->Form->input('User.company_name', array('label' => 'Company Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span12'),'class'=>'validate[required,minSize[3]]'));
/*
        	echo $this->Form->input('User.phone', array('label' => 'Phone<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required,minSize[10]]'));
*/
        	echo '</div><!-- .row -->';
                echo '<div class="row-fluid">';
                echo $this->Form->input('User.street', array('label' => 'Home Address<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span12'),'class'=>'validate[required]'));
        	echo '</div><!-- .row -->';

        	echo '<div class="row-fluid">';
        	echo $this->Form->input('User.city', array('label' => 'City<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required]'));
        	echo $this->Form->input('User.state_id', array('label' => 'State<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required]','type'=>'select','options'=>$states,'empty'=>'Select State'));
        	echo $this->Form->input('User.zip', array('label' => 'Zip<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required,custom[integer],minSize[5]]','data-errormessage-custom-error'=>"* Zip Code can only be numbers"));
        	echo '</div><!-- .row -->';
        	echo '<div class="row-fluid">';
        	echo $this->Form->input('User.phone', array('label' => 'Phone<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required,custom[phone],custom[phone2],minSize[10]]'));
        	echo $this->Form->input('User.ssn', array('label' => 'SSN <a class="pm_tooltip" href="#" data-toggle="tooltip" title="RentSquare requires your social security number to verify your identity in order to accept electronic payments. It will remain private and secure."><i class="icon-question-sign">  </i></a><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required,minSize[9]]'));
        	echo $this->Form->input('User.dob', array('label' => 'DOB (MM/DD/YYYY)<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required,custom[usadate]]'));
/*
*/
        	echo '</div><!-- .row -->';
        	
        	echo '<br><h2 class="reg_subtitle">Enter Your Login Information</h2>';
        	echo '<div class="row-fluid">';
        	echo $this->Form->input('User.email', array('label' => 'Email<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required,custom[email]]'));
        	//echo $this->Form->input('User.confirm_email', array('label' => 'Confirm Email<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'email_equal validate[required,custom[email],equals[UserEmail]]'));
        	//echo '</div><!-- .row -->';
        	//echo '<div class="row-fluid">';
        	echo $this->Form->input('User.password_orig', array('label' => 'Password<br>', 'type' => 'password', 'id' => 'signup_password','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required,minSize[6]]'));
        	//echo $this->Form->input('User.confirm_password', array('label' => 'Confirm Password<br>', 'type' => 'password', 'value' => '','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'pass_equal validate[required,minSize[6],equals[signup_password]]'));
        	echo '</div><!-- .row -->';

        	echo '<div class="clear"><br></div>';
        	echo $this->Html->link(
              "Next <i class='icon-forward icon-white'></i>",
              "#property-info",
              array('escape' => false,'class' => 'btn btn-success next'));
          ?>
          <div class="clear"></div>
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
	</div><!-- #pm_personal -->

	<!-- *****************************************************************
	      Owner Bank Info and Property Info Form 
	     ***************************************************************** -->
	     
  <div id="pm_property" class="hidden pm_step step">
      <div class="register_form">
      <div class="register_wrapper">
        <h1 class="reg_title">
          Property and Bank Information
        </h1>
        <div id="add_properties">
          <div id="property_0" class="add_property">
              <div class="add_property_header">
                  <span class="property_name_left">
                    <span class="property_name">New Property</span> | <span class="property_address">Property Address</span>
                  </span>
                  <span class="close_property">Close</span>
              </div><!-- add_property_header -->
              <div class="property_inside">
                  <h2 class="reg_subtitle">Enter your property address</h2>
              	  <?php
                  echo $this->Form->input('Property.0.name', array('label' => 'Property Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class' => 'property_name_input validate[required]'));
                	echo $this->Form->input('Property.0.address', array('label' => 'Property Address<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'), 'class' => 'property_address_input validate[required]'));
                	echo '<div class="row-fluid">';
                  	 echo $this->Form->input('Property.0.city', array('label' => 'Property City<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required]'));
                  	 echo $this->Form->input('Property.0.state_id', array('label' => 'State<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
                  	 echo $this->Form->input('Property.0.zip', array('label' => 'Zip<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required],minSize[5]'));  
                  echo '</div><!-- .row -->';	
                  echo '<div class="row-fluid">';
                	   echo $this->Form->input('Property.0.num_units', array('label' => 'Number of Units<br>', 'format'=>array('before', 'label', 'error', 'between', 'input', 'after'), 'div' => array('class'=>'span4'),'class'=>'rs_number validate[required,custom[integer]]'));
                	   echo $this->Form->input('Property.0.average_rent', array('label' => 'Average Rent Amount <a class="pm_tooltip" href="#" data-toggle="tooltip" title="Your best guess is OK"><i class="icon-question-sign">  </i></a><br>', 'format'=>array('before', 'label', 'error', 'between', 'input', 'after'), 'div' => array('class'=>'span4'),'class'=>'rs_number validate[required,custom[integer]]'));
                  echo '</div><!-- .row -->';	
                  ?>


                  <h2 class="reg_subtitle">What type of ownership manages this property?</h2>
                  <div class="prev_ownership" style="display:none;">
                    <?php //echo $this->Form->input('Property.0.previous_ownership', array('type'=>'checkbox','label' => '','div'=>false,'format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class' => 'property_name_input','value'=>'1')); ?>
                    
                    <input type="checkbox" name="data[Property][0][previous_ownership]" id="Property0PreviousOwnership" value="1" class="">
                      Use previous Ownership &nbsp;<span class="ownership_select"></span>&nbsp;&nbsp;&nbsp;&nbsp; 
                      <input type="checkbox" name="data[Property][0][new_ownership]" id="Property0NewOwnership" value="1" class="new_ownership_check"> Add New Ownership </div><!-- .prev_ownership -->
                  <?php
                  echo '<div class="new_ownership">';
                    echo '<ul id="ownership_type_list"><li>';
                    echo $this->Form->input('Property.0.ownership_type', array('type'=>'radio','options'=>array('Corporation','LLC','Partnership','Sole Proprietor'),'legend'=>false,'separator'=>'</li><li>','div'=>false,'class'=>'ownership_type validate[required]'));
                    echo '</li></ul><div class="clear"></div><br>';
                    echo '<div class="row-fluid legal_name_div">';
                    //Company Legal Name
                    echo $this->Form->input('Property.0.legal_name', array('label' => 'Company Legal Name <a class="pm_tooltip" href="#" data-toggle="tooltip" title="If you are a sole proprietor you may enter your legal name here."><i class="icon-question-sign"></i></a><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div' => array('class'=>'span6'),'class'=>'comp_legal_name validate[required]'));
                    	 echo $this->Form->input('Property.0.state_inc', array('label' => 'State Incorporated<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
                      //DBA
                    	//echo $this->Form->input('Property.0.legal_dba', array('label' => 'Doing Business As (DBA)<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div' => array('class'=>'span6'),'class'=>'validate[required]'));
                    echo '</div><!-- .row -->';	
                    //Legal Street
                    echo $this->Form->input('Property.0.legal_street', array('label' => 'Legal Street<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required]'));
                    echo '<div class="row-fluid">';
                       //Legal City
                    	 echo $this->Form->input('Property.0.legal_city', array('label' => 'Legal City<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required]'));
                    	 //Legal State
                    	 echo $this->Form->input('Property.0.legal_state_id', array('label' => 'Legal State<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
                    	 //Legal Postal Code
                    	 echo $this->Form->input('Property.0.legal_zip', array('label' => 'Legal Zip<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required],minSize[5]'));  
                    echo '</div><!-- .row -->';
                    echo '<div class="row-fluid">';
                       //Legal Phone
                    	 echo $this->Form->input('Property.0.legal_phone', array('type'=>'tel','label' => 'Legal Phone<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'legal_phone validate[required],minSize[10]'));
                    	 //Legal Fax
                    	 echo $this->Form->input('Property.0.legal_fax', array('type'=>'tel','label' => 'Legal Fax <a class="pm_tooltip" href="#" data-toggle="tooltip" title="This field is optional"><i class="icon-question-sign"></i></a><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'legal_fax'));
                    	 //Company Website
                    	 echo $this->Form->input('Property.0.legal_website', array('label' => 'Legal Website <a class="pm_tooltip" href="#" data-toggle="tooltip" title="This field is optional"><i class="icon-question-sign"></i></a><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4')));  
                    echo '</div><!-- .row -->';
                    echo '<div class="row-fluid">';
                      //Org EIN
/*
                      echo $this->Form->input('Property.0.legal_ein', array('label' => 'Organization EIN#<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div' => array('class'=>'span6'),'class'=>'validate[required,custom[ein]]'));
*/
                       //State Inc
/*
                    	 echo $this->Form->input('Property.0.state_inc', array('label' => 'State Incorporated<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
*/
                    echo '</div><!-- .row -->';
                    echo '<div class="row-fluid">';
                    	 //Year Business Entity Started
                    	 echo $this->Form->input('Property.0.business_started', array('label' => 'Year Business Entity Started<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required],minSize[4]')); 
                    	 //Year Current Ownership Started
                    	 echo $this->Form->input('Property.0.ownership_started', array('label' => 'Year Current Ownership Started<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required],minSize[4]'));  
                    echo '</div><!-- .row -->';
                                      
                  echo '</div><!-- .new_ownership -->';

                  //Bank Info
                  ?>

                  <h2 class="reg_subtitle">Enter your bank account information</h2>
                  <div class="prev_bank" style="display:none;">
                    <input type="checkbox" name="data[Property][0][previous_bank]" id="Property0PreviousBank" value="1"> 
                      Use previous Bank Account &nbsp;<span class="bank_select"></span>&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="data[Property][0][new_bank]" id="Property0NewBank" value="1" class="new_bank_check"> Add New Bank Account </div><!-- .prev_bank -->
                  <div class="new_bank">
                  
                  <div class="row-fluid bank_name_div">
                    <div class="span6">
                      <?php 
                        //Bank Name
                         echo $this->Form->input('Property.0.bank_name', array('label' => 'Bank Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'the_bank_name validate[required]'));
                         //Account Number
                        echo $this->Form->input('Property.0.bank_account_num', array('label' => 'Account Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required]'));
                        //Verify Account Number
                        //echo $this->Form->input('Property.0.verify_bank_account_num', array('label' => 'Verify Account Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required],equals[Property0BankAcccountNum] bank_acc_equal'));
                        //Routing Number
                        echo $this->Form->input('Property.0.routing_number', array('label' => 'Routing Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required,custom[aba]],minSize[9]'));
                        //Verify Routing Number
                        //echo $this->Form->input('Property.0.confirm_routing_number', array('label' => 'Confirm Routing Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required],equals[Property0RoutingNumber] bank_rout_equal'));
                      ?>
                    </div><!-- span6 -->
                    <div class="span6">
                       <?php 
                         //Type of Account
                         echo $this->Form->input('Property.0.bank_account_type', array('type'=>'select','label' => 'Type of Account<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'options' => array('Checking'=>'Checking','Savings'=>'Savings'),'empty'=>'Select Type','class'=>'validate[required]'));
                         //Check Image
                         //check_example.png
                        echo $this->Html->image('check_example.png');
                       ?>
                    </div><!-- span6 -->
                  </div><!-- .row -->
                  </div><!-- .new_bank -->
                  <br>
                  <a href="#" class="remove_prop btn btn-mini" style="display:none;"><i class="icon-remove"></i> Remove Property</a>
              </div><!-- .property_inside -->
          </div><!-- .add_property -->
        
        </div><!-- .add_properties -->
        
        <?php 
        	echo $this->Html->link(
              "Save and Add Another Property",
              "#",
              //array('escape' => false,'class' => 'btn add_prop'));
              array('escape' => false,'class' => 'btn add_prop'));
          echo '<div class="clear"><br><br></div>';
          echo $this->Html->link(
              "Next <i class='icon-forward icon-white'></i>",
              "#complete",
              array('escape' => false,'class' => 'btn btn-success next start_summary')); 
          echo $this->Html->link(
              "<i class='icon-backward icon-white'></i> Back",
              "#personal-info",
              array('escape' => false,'class' => 'btn btn-inverse back'));  
          ?>
          <div class="clear"></div>
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
  </div><!-- #pm_property -->
  
  <!-- *****************************************************************
	      Summary Fees / Complete Reg Form 
	     ***************************************************************** -->
	     
  <div id="pm_complete" class="hidden pm_step step">
      <div class="register_form">
      <div class="register_wrapper">
        <h1 class="reg_title complete_reg">Complete Registration</h1>
        <h2 class="sub_title">Property Summary<span class="mon_fee">Monthly Fee</span><span class="one_time_fee">One-Time Setup Fee</span><span class="units_num">#Units</span></h2>
        <ul class="property_review">
    
        </ul><!-- .property_review -->
        <div class="clear"></div>
        <div class="summary_total">
        	Total:
        	<div class="fee">
        		<span id="sum_month_fee">$0</span>
        	</div><!-- .fee -->
        	<div class="fee">
        		<span id="sum_one_time_fee">$0</span>
        	</div><!-- .fee -->
        	<div class="fee">
        		<span id="sum_total_units" class="">0</span>
        	</div><!-- .fee -->
        </div><!-- .summary_total -->
        <div class="clear"></div>
        <div class="summary_desc">
          *Monthly Fee of <strong><span id="sum_monthly_fee"></span></strong> begins upon signup. The monthly fee for each property will be debited from the bank accounts provided for each property.<br>
          *The one-time setup fee cost is equal to one month of service.
        </div><!-- .summary_desc -->
        <div class="clear"><br></div><!-- .clear -->
        <div class="terms">
        	I agree to the RentSquare <a href="/RentSquare-Landlord-Service-Agreement.pdf" target="_blank" style="color: #0088cc;">Landlord Service Agreement</a> <?php echo $this->Form->input('Agreement.agreeTerms', array('label'=>'','type'=>'checkbox','class'=>'validate[required]')); ?>
        </div><!-- .terms -->
        <div class="clear"><br><br></div>
          <?php
          	echo $this->Form->submit('Register',array('class'=>'btn btn-success'));
          	echo $this->Html->link(
              "<i class='icon-backward icon-white'></i> Back",
              "#property-info",
              array('escape' => false,'class' => 'btn btn-inverse back')); 
          	
          ?>
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
  </div><!-- .pm_complete -->
  <?php echo $this->Form->end(); ?>
  <div class="clear"></div>
</div><!-- #form_wrapper -->
<div class="clear"></div>
<?php if(!isset($error_messages)): ?>
<script>
//Property Manager Signup - Add Get Started Dialog
jQuery(function(){
	jQuery('#getStartedModal').modal('show');
	jQuery('.im-not-ready').click(function(){
    jQuery('#getStartedModal').modal('hide');
    jQuery('#notReadyModal').modal('show');	
	});
	jQuery('#UserPhone,#Property0LegalPhone,#Property0LegalFax').on('change',function(e){
		jQuery(this).val(jQuery(this).val().replace(/\D/g,''));
		return true;
	});
	$pm1 = jQuery('#pm_personal');
	$pm1_bottom = $pm1.offset().top + $pm1.height()+30;
	$pm3 = jQuery('#pm_complete');
	$pm3_bottom = $pm3.offset().top + $pm3.height()+30;
	$(window).scroll(function () {
	  if($pm1.css('opacity') == "1"){
  	  if ($(window).scrollTop()  > $pm1_bottom) {
        jQuery('html,body').stop().animate({scrollTop: 0 }, 400, "linear");
      } 
	  }
	  if($pm3.css('opacity') == "1"){
  	  if ($(window).scrollTop()  > $pm3_bottom) {
        jQuery('html,body').stop().animate({scrollTop: 0 }, 400, "linear");
      } 
	  }
  });
  
});
jQuery(document).on("keypress", 'form', function (e) {
var code = e.keyCode || e.which;
if (code == 13) {
    e.preventDefault();
    return false;
}
});
</script>
<?php endif; ?>
