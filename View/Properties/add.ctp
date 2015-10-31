<div id="add_property_wrapper" style="width:90%;">
<div class="top_head">
	Add New Property
</div><!-- .top_head -->

<div class="block_title payment_meth_title">
	Property and Bank Information
</div><!-- .block_title -->
<div class="gray_block" style="padding-top: 17px;">

<?php
  //Start Property Manager Sign Up Form
	echo $this->Form->create('Property', array('action' => 'add'));
?>
	
	<!-- *****************************************************************
	      Owner Personal Info Form 
	     ***************************************************************** -->
	
       <!-- Already Captured -->

	<!-- *****************************************************************
	      Owner Bank Info and Property Info Form 
	     ***************************************************************** -->
	     
  <div id="pm_property" class=" pm_step step">
      <div class="register_form">
      <div class="register_wrapper">
        <div id="add_properties">
          <div id="property_0" class="add_property">
              
              <div class="property_inside">
                  <h2 class="reg_subtitle">Enter your property address</h2>
              	  <?php
                  echo $this->Form->input('Property.name', array('label' => 'Property Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class' => 'property_name_input validate[required]'));
                	echo $this->Form->input('Property.address', array('label' => 'Property Address<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'), 'class' => 'property_address_input validate[required]'));
                	echo '<div class="row-fluid">';
                  	 echo $this->Form->input('Property.city', array('label' => 'Property City<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required]'));
                  	 echo $this->Form->input('Property.state_id', array('label' => 'State<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
                  	 echo $this->Form->input('Property.zip', array('label' => 'Zip<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required],minSize[5]'));  
                  echo '</div><!-- .row -->';	
                  echo '<div class="row-fluid">';
                	   echo $this->Form->input('Property.num_units', array('label' => 'Number of Units<br>', 'format'=>array('before', 'label', 'error', 'between', 'input', 'after'), 'div' => array('class'=>'span4'),'class'=>'validate[required]'));
                	   echo $this->Form->input('Property.average_rent', array('label' => 'Average Rent Amount <a class="pm_tooltip" href="#" data-toggle="tooltip" title="Your best guess is OK"><i class="icon-question-sign">  </i></a><br>', 'format'=>array('before', 'label', 'error', 'between', 'input', 'after'), 'div' => array('class'=>'span4'),'class'=>'validate[required]'));
                  echo '</div><!-- .row -->';	
                  ?>

                  <h2 class="reg_subtitle">What type of ownership manages this property?</h2>
                  <div class="prev_ownership" style="display:none;">
                    <?php //echo $this->Form->input('Property.previous_ownership', array('type'=>'checkbox','label' => '','div'=>false,'format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class' => 'property_name_input','value'=>'1')); ?>
                    
                    <input type="checkbox" name="data[Property][0][previous_ownership]" id="PropertyPreviousOwnership" value="1">
                      Use previous Ownership Company &nbsp;<span class="ownership_select"></span>&nbsp;&nbsp;&nbsp;&nbsp; 
                      <input type="checkbox" name="data[Property][0][new_ownership]" id="PropertyNewOwnership" value="1" class="new_ownership_check"> Add New Ownership </div><!-- .prev_ownership -->
                  <?php
                  echo '<div class="new_ownership">';
                    echo '<ul id="ownership_type_list"><li>';
                    echo $this->Form->input('Property.ownership_type', array('type'=>'radio','options'=>array('Corporation','LLC','Partnership','Sole Proprietor'),'legend'=>false,'separator'=>'</li><li>','div'=>false,'class'=>'ownership_type validate[required]'));
                    echo '</li></ul><div class="clear"></div><br>';
                    echo '<div class="row-fluid legal_name_div">';
                    //Company Legal Name
                    echo $this->Form->input('Property.legal_name', array('label' => 'Company Legal Name <span style="font-size: 11px;">(If you are a sole proprietor you may enter your legal name here.)</span><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div' => array('class'=>'span8'),'class'=>'comp_legal_name validate[required]'));
                    //State Inc
                    echo $this->Form->input('Property.state_inc', array('label' => 'State Incorporated<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
                    //DBA
                    //echo $this->Form->input('Property.legal_dba', array('label' => 'Doing Business As (DBA)<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div' => array('class'=>'span6'),'class'=>'validate[required]'));
                    echo '</div><!-- .row -->';	
                    //Legal Street
                    echo $this->Form->input('Property.legal_street', array('label' => 'Legal Street<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required]'));
                    echo '<div class="row-fluid">';
                       //Legal City
                    	 echo $this->Form->input('Property.legal_city', array('label' => 'Legal City<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required]'));
                    	 //Legal State
                    	 echo $this->Form->input('Property.legal_state_id', array('label' => 'Legal State<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'type'=>'select','options'=>$states,'empty'=>'Select State','class'=>'validate[required]'));
                    	 //Legal Postal Code
                    	 echo $this->Form->input('Property.legal_zip', array('label' => 'Legal Zip<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required],minSize[5]'));  
                    echo '</div><!-- .row -->';
                    echo '<div class="row-fluid">';
                       //Legal Phone
                    	 echo $this->Form->input('Property.legal_phone', array('label' => 'Legal Phone<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4'),'class'=>'validate[required],minSize[10]'));
                    	 //Legal Fax
                    	 echo $this->Form->input('Property.legal_fax', array('label' => 'Legal Fax <a class="pm_tooltip" href="#" data-toggle="tooltip" title="This field is optional"><i class="icon-question-sign"></i></a><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4')));
                    	 //Company Website
                    	 echo $this->Form->input('Property.legal_website', array('label' => 'Legal Website <a class="pm_tooltip" href="#" data-toggle="tooltip" title="This field is optional"><i class="icon-question-sign"></i></a><br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span4')));  
                    echo '</div><!-- .row -->';
                    echo '<div class="row-fluid">';
                    //Org EIN
                    //echo $this->Form->input('Property.legal_ein', array('label' => 'Organization EIN#<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div' => array('class'=>'span6'),'class'=>'validate[required,custom[ein]]'));
                    echo '</div><!-- .row -->';
                    echo '<div class="row-fluid">';
                    	 //Year Business Entity Started
                    	 echo $this->Form->input('Property.business_started', array('label' => 'Year Business Entity Started<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required],minSize[4]')); 
                    	 //Year Current Ownership Started
                    	 echo $this->Form->input('Property.ownership_started', array('label' => 'Year Current Ownership Started<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'div'=>array('class'=>'span6'),'class'=>'validate[required],minSize[4]'));  
                    echo '</div><!-- .row -->';
                                      
                  echo '</div><!-- .new_ownership -->';

                    
                  //Bank Info
                  ?>
                  <h2 class="reg_subtitle">Enter your bank account information</h2>
                  <div class="prev_bank" style="display:none;">
                    <input type="checkbox" name="data[Property][0][previous_bank]" id="PropertyPreviousBank" value="1"> 
                      Use previous Bank Account &nbsp;<span class="bank_select"></span>&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="data[Property][0][new_bank]" id="PropertyNewBank" value="1" class="new_bank_check"> Add New Bank Account </div><!-- .prev_bank -->
                  <div class="new_bank">
                  
                  <div class="row-fluid bank_name_div">
                    <div class="span6">
                      <?php 
                        //Bank Name
                         echo $this->Form->input('Property.bank_name', array('label' => 'Bank Name<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'the_bank_name validate[required]'));
                         //Account Number
                        echo $this->Form->input('Property.bank_account_num', array('label' => 'Account Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required]'));
                        //Verify Account Number
                        //echo $this->Form->input('Property.verify_bank_account_num', array('label' => 'Verify Account Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required],equals[PropertyBankAcccountNum] bank_acc_equal'));
                        //Routing Number
                        echo $this->Form->input('Property.routing_number', array('label' => 'Routing Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required,integer,custom[aba]],minSize[9],maxSize[9]'));
                        //Verify Routing Number
                        //echo $this->Form->input('Property.confirm_routing_number', array('label' => 'Confirm Routing Number<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'class'=>'validate[required],equals[PropertyRoutingNumber] bank_rout_equal'));
                      ?>
                    </div><!-- span6 -->
                    <div class="span6">
                       <?php 
                         //Type of Account
                         echo $this->Form->input('Property.bank_account_type', array('type'=>'select','label' => 'Type of Account<br>','format'=>array('before', 'label', 'error', 'between', 'input', 'after'),'options' => array('Checking'=>'Checking','Savings'=>'Savings'),'empty'=>'Select Type','class'=>'validate[required]'));
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
        	/*
echo $this->Html->link(
              "Save and Add Another Property",
              "#",
              array('escape' => false,'class' => 'btn add_prop'));
*/
          echo '<div class="clear"><br><br></div>';
          /*
echo $this->Html->link(
              "Next <i class='icon-forward icon-white'></i>",
              "#complete",
              array('escape' => false,'class' => 'btn btn-success next start_summary')); 
          echo $this->Html->link(
              "<i class='icon-backward icon-white'></i> Back",
              "#personal-info",
              array('escape' => false,'class' => 'btn btn-inverse back')); 
*/ 
          ?>
          <div class="clear"></div>
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
  </div><!-- #pm_property -->
  
  <!-- *****************************************************************
	      Summary Fees / Complete Reg Form 
	     ***************************************************************** -->
	     
  <div id="pm_complete" class=" pm_step step">
      <div class="register_form">
      <div class="register_wrapper">
        <h1 class="reg_title complete_reg">Fees</h1>
        <h2 class="sub_title">&nbsp;<span class="mon_fee">Monthly Fee</span><span class="one_time_fee">One-Time Setup Fee</span><span class="units_num">#Units</span></h2>
        <ul class="property_review">
          
        </ul><!-- .property_review -->
        <div class="clear"></div>
        <div class="summary_total">
        	Fee Total:
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
          *Monthly Fee of <strong><span id="sum_monthly_fee"></span></strong> begins when your account is approved. The monthly fee for each property will be debited from the bank accounts provided for each Property.<br>
          *The one-time setup fee cost is equal to 1 month of service.
        </div><!-- .summary_desc -->
        <div class="clear"><br></div><!-- .clear -->
        <div class="terms">
        	I agree to the RentSquare <a href="/RentSquare-Landlord-Service-Agreement.pdf" target="_blank" style="color: #0088cc;">Landlord Service Agreement</a> <?php echo $this->Form->input('Agreement.agreeTerms', array('label'=>'','type'=>'checkbox','class'=>'validate[required]')); ?>
        </div><!-- .terms -->
        <div class="clear"><br><br></div>
          <?php
          	echo $this->Form->submit('Add Property',array('class'=>'btn btn-success'));
          	/*
              echo $this->Html->link(
              "<i class='icon-backward icon-white'></i> Back",
              "#Property0-info",
              array('escape' => false,'class' => 'btn btn-inverse back'));
            */ 
          	
          ?>
      </div><!-- .register_wrapper -->
      </div><!-- .register_form -->
  </div><!-- .pm_complete -->
  <?php echo $this->Form->end(); ?>
  <div class="clear"></div>
</div><!-- block_content -->
</div><!-- #form_wrapper -->
<div class="clear"></div>
<script>
    
  var propertyCount = 1; 
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
    
    jQuery(function(){
      
        //Property Manager Signup - Add tooltips 
        jQuery('.pm_tooltip').tooltip();
  
    	//Set up form Validation
    	jQuery("#UserPropertymanagerForm").validationEngine({
    	   'promptPosition' : 'topRight:-93', scroll: true,
    	   'custom_error_messages' : {
      	     '.pass_equal':{
        	     'equals':{
          	     'message' : '* Passwords do not match'
        	     }
      	     },
      	     '.email_equal':{
        	     'equals':{
          	     'message' : '* Emails do not match'
        	     }
      	     },
      	     '.bank_acc_equal':{
        	     'equals':{
          	     'message' : '* Bank Accounts do not match'
        	     }
      	     },
      	     '.bank_rout_equal':{
        	     'equals':{
          	     'message' : '* Routing Numbers do not match'
        	     }
      	     },
    	   }
      }); 
      //Property Manager Signup - Ownership Type Radio Button
      jQuery('.ownership_type').change(function(){
          if ($("#PropertyOwnershipType0").attr("checked")) { 
            //Corporation
            jQuery('#PropertyStateInc').show().parent().show();
            jQuery('#PropertyLegalEin').show().parent().show();
          }
          if ($("#PropertyOwnershipType1").attr("checked")) { 
            //LLC
            jQuery('#PropertyStateInc').show().parent().show();
            jQuery('#PropertyLegalEin').show().parent().show();
          }
          if ($("#PropertyOwnershipType2").attr("checked")) { 
            //Partnership
            jQuery('#PropertyStateInc').hide().parent().hide();
            jQuery('#PropertyLegalEin').show().parent().show();
          }
          if ($("#PropertyOwnershipType3").attr("checked")) { 
            //Sole Proprietor
            jQuery('#PropertyStateInc').hide().parent().hide();
            jQuery('#PropertyLegalEin').hide().parent().hide();
          }
      });
      jQuery('#PropertyNumUnits').change(function(){
        $prop_sum = "";
        $unit_total = 0;
        $month_total = 0;
        for(i=0; i<propertyCount; i++){
            $prop_name = jQuery('#PropertyName').val();
            $num_units = jQuery('#PropertyNumUnits').val();
            $month_fee = get_monthly_fee($num_units);
            $month_total = $month_total + $month_fee;
            if(jQuery('#PropertyPreviousBank').is(':checked')){
                $prev_val = jQuery('#PropertyPrevBank').val();
                $bank_acct = jQuery('#PropertyBankAcccountNum').val();
                $bank_name = jQuery('#PropertyBankName').val();
            } else {
                $bank_acct = jQuery('#PropertyBankAcccountNum').val();
                $bank_name = jQuery('#PropertyBankName').val();
            }
            $unit_total = $unit_total + parseInt($num_units);
            /*
if($prop_name != "" && $prop_name != null && $num_units !="" && $num_units!=0 && $num_units!=null){
              $prop_sum = $prop_sum + '<li class="prop_'+i+'"><div class="prop_sum"><h1 class="prop_title">'+$prop_name+ '</h1><!-- .prop_title -->'+
                  '<span class="prop_address">'+jQuery('#Property'+i+'Address').val()+'</span>'+
                  '<span class="bank_nm">'+$bank_name+'</span><span class="acc_num">Acct# '+$bank_acct+'</span>'+
                '</div><!-- .prop_sum -->'+
                '<div class="num_units">'+
                	$num_units+
                '</div><!-- .num_units -->'+
                '<div class="setup_fee">'+
                	'$'+ ($month_fee * 1)+
                '</div><!-- .setup_fee -->'+
                '<div class="month_fee">'+
                	'$'+$month_fee+
                '</div><!-- .month_fee -->'+
                '<div class="clear"></div>'+
              '</li>';
            }
*/
        }
        jQuery('#sum_total_units').html($unit_total);
        jQuery('#sum_one_time_fee').html('$'+($month_total*1));
        jQuery('#sum_month_fee,#sum_monthly_fee').html('$'+$month_total);
        //var now = new Date();
        //current = new Date(now.getFullYear(), now.getMonth()+1, 1);
        
        jQuery('ul.property_review li').remove();
        //jQuery('ul.property_review').append($prop_sum);
      });
  });
	
</script>
