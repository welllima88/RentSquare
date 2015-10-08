<!-- Modal To Add Unit -->
<div id="add_unit_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="addUnit" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add New Unit(s)</h3><br>
    Add a single unit or multiple units separated by commas e.g. 102,102-A,104,105.
  </div>
  <?php echo $this->Form->create('Unit', array('controller' => 'Units', 'action' => 'add','inputDefaults' => array(
        'label' => false,
        'div' => false
    ))); ?>
  <div class="modal-body add-unit-modal">
    <p>
      <?php
      	echo $this->Form->input('Unit.number', array('label' => '<span class="section_title">Unit Number</span>','placeholder' => '102,103,103A,105','maxlength'=>'250','class'=>'validate[required]'));
      	echo '<div class="form_input">';
      	   echo $this->Form->input('Unit.beds', array('label' => '# of Bedrooms','placeholder' => 'Beds','class'=>'num_bed validate[required,onlyNumber]'));
        echo '</div><!-- .form_input -->';
      	echo '<div class="form_input">';
      	   echo $this->Form->input('Unit.baths', array('label' => '# of Bathrooms','placeholder' => 'Baths','class'=>'validate[required,onlyNumber]'));
        echo '</div><!-- .form_input -->';
        echo '<div class="form_input">';
        	 echo $this->Form->input('Unit.square_feet', array('label' => 'Square Feet','placeholder' => 'Square Feet','class'=>'validate[required]'));
        echo '</div><!-- .form_input -->';
      
        /*
echo '<div class="form_input">';
        	 echo $this->Form->hidden('Unit.transaction_fee');
        	 echo '<label for="Unitoccupied">Who Pays<br>Transaction Fee</label><div class="btn-group" data-toggle="buttons-radio">
        	         <button type="button" class="btn btn_transaction_fee">Resident</button>
        	         <button type="button" class="btn btn_transaction_fee">Property</button>
                 </div>';
           echo ' &nbsp;&nbsp;<a href="#" id="trans_fee_tip" rel="tooltip" title="RentSquare charges a small convenience fee when residents pay rent through our system. For maximum flexibility, we give you the choice of who will pay this fee. Select &quot;Resident&quot; to pass the convenience fee to the resident or &quot;Property&quot; to incur the convenience fee on behalf of the resident"><i class="icon-info-sign"></i></a>';
        echo '</div><!-- .form_input -->';
*/

         // Lease Information
        echo '<hr class="eee_border">';
        echo '<h2>Lease Information</h2>';
        echo '<div class="form_input">';
            echo $this->Form->input('Unit.lease_start', array('type'=>'text', 'label' => 'Lease Start','placeholder' => 'Start Date', 'class' => 'datepicker'));
        echo '</div><!-- .form_input -->';
        echo '<div class="form_input">';
            echo $this->Form->input('Unit.lease_end', array('type'=>'text','label' => 'Lease End','placeholder' => 'End Date','class' => 'datepicker'));
        echo '</div><!-- .form_input -->';
        echo '<div class="form_input rent_freq_tt">';
          	echo '<label for="UnitRent">Billing Frequency</label>';
          	echo $this->Form->input('Unit.billing_frequency',array('type'=>'select','options'=>$frequency,'default'=>'4'));
          	echo ' &nbsp;<a href="#" id="rent_due_on" rel="tooltip" title="This field determines the frequency you wish to bill your residents. Note: If you select &quot;Twice a Month&quot;, the resident will be billed on the 1st and the 15th of each month."><i class="icon-info-sign"></i></a>';
          	echo '<br>';
          	echo '<div id="freq_weekly" class="hide_input freq_input">';
          		echo $this->Form->input('Unit.weekly_day', array('type'=>'select', 'options'=>array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'), 'label'=>'Rent is due on &nbsp;'));
          	echo '</div><!-- #freq_weekly -->';
          	echo '<div id="freq_twice_month" class="hide_input freq_input">';
          		echo '*Rent is due on the 1st and 15th of each month.';
          	echo '</div><!-- #freq_weekly -->';
          	echo '<div id="freq_monthly" class="hide_input freq_input" style="display:block;">';
          		echo $this->Form->input('Unit.monthly_day', array('type'=>'select', 'options'=>array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','last'), 'label'=>'Rent is due on the &nbsp;')) . ' &nbsp;&nbsp;&nbsp;day of the month';
          	echo '</div><!-- #freq_weekly -->';
          	echo '<div id="freq_yearly" class="hide_input freq_input">';
          		echo $this->Form->input('Unit.yearly_date', array('type'=>'text','label' => 'Billing start date','placeholder' => 'Start Date','class' => 'datepicker'));
          	echo '</div><!-- #freq_weekly -->';
          	
        echo '</div><!-- .form_input -->';
        
        // Unit Charges
        echo '<hr class="eee_border">';
        echo '<h2>Unit Charges</h2>';
        echo '<div class="unit_charges_title"><span class="fee_title_name">Name</span><span class="fee_title_amount">Amount</span><span class="fee_title_frequency">Frequency</span><span>One Time Fee Date</span></div><!-- .unit_charges_title -->';
        echo '<div class="form_input">';
          	echo '<label for="UnitRent">Base Rent</label><div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>';
          	echo $this->Form->input('Unit.rent', array('placeholder' => 'Rent','class'=>'dollar_input','type'=>'text','pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01'));
          	echo $this->Form->input('Unit.rent_freq', array('type'=>'select','disabled'=>true,'options'=>array(0=>'Recurring',1=>'One Time')));
          	echo '</div>';
        echo '</div><!-- .form_input -->';
        echo '<div class="fees_section" class="form_input"></div>';
        echo '<a href="#" id="add_fee" class="btn btn-inverse btn-mini"><i class="icon-plus-sign icon-white"></i> Add Charge</a><br><br>';
       
        
        echo '<hr class="eee_border">';
        echo '<h2>Free Rent</h2>';?>
        <div id="free_rent_error" style="display:none;">
        	Please enter a start and end lease date before adding free rent.<br><br>
        </div><!-- #free_rent_error -->
        <div id="free_rent_block"></div>
        <div class="clear"></div>
        <a class="btn btn-inverse btn-mini" id="add_unit_free_rent"><i class="icon-plus-sign icon-white"></i> Add Free Rent</a>
        
    </p> 
    <br><br><br>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-success">Add Unit</button>
  </div>
  <?php echo $this->Form->end(); ?>
</div>

<script>

$( document ).ready(function() {
});

var $strNum = 0;
var $free_rent_num = 0;
// Add Fee Button Click adds new row for Unit Fee
jQuery('#add_fee').click(function(e) {
  e.preventDefault();
  $strNum = jQuery('.additional_fee').last().attr('id');
  if($strNum == null || $strNum == ""){
    $num="0";
  } else {
    $strNum = $strNum.replace('fee_','');
    $num = parseInt($strNum,10) + 1;
    $num = $num.toString();
  }
  $append = '<div id="fee_' + $num + '" class="additional_fee"><a class="rs-button-delete ir" href="#">Remove</a><?php
        echo trim($this->Form->input('UnitFee.0.name', array('placeholder' => 'Fee Name', 'class' => 'fee_name' )));
        echo '<div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>' . trim($this->Form->input('UnitFee.0.amount', array('placeholder' => 'Amount','class'=>'dollar_input'))) . '</div>';
        echo str_replace(PHP_EOL, '',trim($this->Form->input('UnitFee.0.one_time',array('type'=>'select','class'=>'onetime_fee','options'=>array(0=>'Recurring',1=>'One Time')))));
        echo $this->Form->input('UnitFee.0.one_time_date', array('type'=>'text','placeholder' => 'Fee Date','class' => 'datepicker_fee one_time_date'));
      ?></div><!-- .additional_fee -->'.replace(/\[0\]/g,'['+ $num + ']');
  $append = $append.replace(/Fee0/g,'Fee'+$num); 
  jQuery('.fees_section').append($append);
  //jQuery('#UnitFee'+$num+'Name').focus();
    jQuery('.rs-button-delete').click(function(e){
    e.preventDefault();
    jQuery(this).parent('.additional_fee').remove();
  });
  jQuery('.onetime_fee').change(function() {
    if(jQuery(this).val() == "1"){
      jQuery(this).next('.one_time_date').fadeIn();
    } else {
      jQuery(this).next('.one_time_date').fadeOut().val('');
    }
  });
  jQuery('.datepicker_fee').datepicker({
      changeMonth: true,
      changeYear: true
  });
});

// Sets Occupied Yes/No and Transaction Fee button on click
jQuery(function() {
    jQuery('.btn_occupied').click(function(e){
      e.preventDefault();
      jQuery('#UnitOccupied').val(jQuery(this).html());
    });
    /*
      jQuery('.btn_transaction_fee').click(function(e){
      e.preventDefault();
      jQuery('#UnitTransactionFee').val(jQuery(this).html());
    });
    */
    jQuery('#trans_fee_tip,#rent_due_on').tooltip({'html':true});
    jQuery('#UnitLeaseStart,#UnitLeaseEnd').change(function(){
      jQuery('#free_rent_block').find('.add_free_rent_item').remove();
    });

});

// Set datepicker jQuery UI plugin on add unit form
jQuery('#add_unit_modal').on('show', function () {
    //gw Modify fields to remove unwanted chars after user leaves focus
   jQuery('#UnitSquareFeet').on('change',function(e0){
            jQuery(this).val(jQuery(this).val().replace(/\D/g,''));
            return true;
   });
   jQuery('#UnitRent').on('change',function(e1){
            jQuery(this).val(jQuery(this).val().replace(/,/g,''));
            return true;
   });

  jQuery('.datepicker').datepicker({
      changeMonth: true,
      changeYear: true
  });
  //Free Rent
    jQuery('#add_unit_free_rent').unbind('click').click(function (){
      jQuery('#free_rent_error').hide();
      if(jQuery('#UnitLeaseStart').val() == "" || jQuery('#UnitLeaseEnd').val() == ""){
        jQuery('#free_rent_error').fadeIn();
        return false;
      } else{
        free_rent();
      }
    });
  //Validation
  jQuery("#UnitAddForm").validationEngine('attach',{
    	   promptPosition : 'centerRight', scroll: true,
         'custom_error_messages' : {
      	     '.num_bed':{
        	     'onlyNumber':{
          	     'message' : '* Must be number.'
        	     }
      	     },
    	   }
    
    });

});

//Billing Frequency Additional Information
jQuery('#UnitBillingFrequency').change(function(){
  jQuery('.freq_input').hide();
  switch(jQuery(this).val()){
    case '2':
      jQuery('#freq_weekly').fadeIn();
    break;
    case '3':
      jQuery('#freq_twice_month').fadeIn();
    break;
    case '4':
      jQuery('#freq_monthly').fadeIn();
    break;
    case '5':
    case '6':
    case '7':
     jQuery('#freq_yearly').fadeIn();
    break;
    default:
    break;
  }
});


function free_rent(){

  $lease_start = new Date(jQuery('#UnitLeaseStart').val());
  $lease_end = new Date(jQuery('#UnitLeaseEnd').val());
  
  $rent_range_options = [];
  $range_start = new Date($lease_start.getTime());
  
  switch(jQuery('#UnitBillingFrequency').val()){
    case '1':
      //daily
      //loop through daily range until get to lease end date
      while($range_start.getTime() < $lease_end.getTime()){    
          $range_start_plus_1 = new Date($range_start.getTime());
          $range_start_plus_1.setDate($range_start_plus_1.getDate()+1);
          $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_plus_1.getMonth()+1) + '/' + $range_start_plus_1.getDate() + '/' + $range_start_plus_1.getFullYear());
          $range_start.setDate($range_start.getDate()+1);
      }
    break;
    case '2':
      //weekly
      //loop through weekly range until get to lease end date
      //get week day on which rent is due and find first date of that day after the lease start day
      $range_start.setDate($range_start.getDate() + (parseInt(jQuery('#UnitWeeklyDay').val()) - 1 - $range_start.getDay() + 7) % 7 + 1);
      while($range_start.getTime() < $lease_end.getTime()){
          $range_start_plus_6 = new Date($range_start.getTime());
          $range_start_plus_6.setDate($range_start_plus_6.getDate()+6);
          $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_plus_6.getMonth()+1) + '/' + $range_start_plus_6.getDate() + '/' + $range_start_plus_6.getFullYear());
          $range_start.setDate($range_start.getDate()+7);
      } 
    break;
    case '3':
      //twice a month
       $date_of_month = $range_start.getDate();
       if($date_of_month == 1){
         $range_start.setDate(1);
       } else if($date_of_month > 1 && $date_of_month <= 15){
         $range_start.setDate(15);
       } else {
         $range_start.setMonth($range_start.getMonth()+1);
         $range_start.setDate(1);
       }
       while($range_start.getTime() < $lease_end.getTime()){
       //range_start should be 1st or 15th
        $range_start_plus_15 = new Date($range_start.getTime());
        if($range_start.getDate() == '15'){
           $range_start_plus_15.setMonth($range_start.getMonth()+1);
           $range_start_plus_15.setDate(0);
           
           $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_plus_15.getMonth()+1) + '/' + $range_start_plus_15.getDate() + '/' + $range_start_plus_15.getFullYear());
           $range_start.setMonth($range_start.getMonth()+1);
           $range_start.setDate(1);
         } else {
           $range_start_plus_15.setDate(15);
           $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_plus_15.getMonth()+1) + '/' + $range_start_plus_15.getDate() + '/' + $range_start_plus_15.getFullYear());
           $range_start.setDate(15);
         }
      }
    break;
    case '4':
      //monthly
      
      $lease_start_date = parseInt($lease_start.getDate());
      $date_of_month = parseInt(jQuery('#UnitMonthlyDay').val())+1;
      if($date_of_month == 29){
        //last day of month
        $range_start.setMonth($range_start.getMonth()+1);
        $range_start.setDate(0);
        while($range_start.getTime() < $lease_end.getTime()){
          $range_start_month = new Date($range_start.getTime());
          $range_start_month.setMonth($range_start_month.getMonth()+2);
          $range_start_month.setDate(0);
          $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_month.getMonth()+1) + '/' + $range_start_month.getDate() + '/' + $range_start_month.getFullYear());
          $range_start.setMonth($range_start.getMonth()+2);
          $range_start.setDate(0);
        }
      }
      else {  //not last day of month
        if($lease_start_date <= $date_of_month){
          $range_start.setDate($date_of_month);
        }
        else{
          $range_start.setMonth($range_start.getMonth()+1);
          $range_start.setDate($date_of_month);
        }
        while($range_start.getTime() < $lease_end.getTime()){
            $range_start_month = new Date($range_start.getTime());
            $range_start_month.setMonth($range_start_month.getMonth()+1);
            $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_month.getMonth()+1) + '/' + $range_start_month.getDate() + '/' + $range_start_month.getFullYear());
            $range_start.setMonth($range_start.getMonth()+1);
        }
      }
    break;
    case '5':
      //quarterly (every 3 months)
      $yearly_billing_date = new Date(jQuery('#UnitYearlyDate').val());
      if($yearly_billing_date.getTime() > $lease_start.getTime()){
        $range_start = new Date($yearly_billing_date.getTime());
      }
      while($range_start.getTime() < $lease_end.getTime()){    
          $range_start_quarter = new Date($range_start.getTime());
          $range_start_quarter.setMonth($range_start_quarter.getMonth()+3);
          $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_quarter.getMonth()+1) + '/' + $range_start_quarter.getDate() + '/' + $range_start_quarter.getFullYear());
          $range_start.setMonth($range_start.getMonth()+3);
      }

    break;
    case '6':
      //semi-annually (every 6 months)
      $yearly_billing_date = new Date(jQuery('#UnitYearlyDate').val());
      if($yearly_billing_date.getTime() > $lease_start.getTime()){
        $range_start = new Date($yearly_billing_date.getTime());
      }
      while($range_start.getTime() < $lease_end.getTime()){    
          $range_start_semi_ann = new Date($range_start.getTime());
          $range_start_semi_ann.setMonth($range_start_semi_ann.getMonth()+6);
          $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_semi_ann.getMonth()+1) + '/' + $range_start_semi_ann.getDate() + '/' + $range_start_semi_ann.getFullYear());
          $range_start.setMonth($range_start.getMonth()+6);
      }
    break;
    case '7':
      //anually
      $yearly_billing_date = new Date(jQuery('#UnitYearlyDate').val());
      if($yearly_billing_date.getTime() > $lease_start.getTime()){
        $range_start = new Date($yearly_billing_date.getTime());
      }
      while($range_start.getTime() < $lease_end.getTime()){    
          $range_start_ann = new Date($range_start.getTime());
          $range_start_ann.setMonth($range_start_ann.getMonth()+12);
          $rent_range_options.push( ($range_start.getMonth()+1) + '/' + $range_start.getDate() + '/' + $range_start.getFullYear() + ' - ' + ($range_start_ann.getMonth()+1) + '/' + $range_start_ann.getDate() + '/' + $range_start_ann.getFullYear());
          $range_start.setMonth($range_start.getMonth()+12);
      }
    break;
    default:
      //do nothing
    break;
  }
  //Get First and Last dates from string
  if($free_rent_num == null || $free_rent_num == ""){
    $num="0";
    $free_rent_num = "0";
  } else {
    $num = parseInt($free_rent_num,10) + 1;
    $num = $num.toString();
    $free_rent_num = $num;
  }
  if($rent_range_options.length == 0) { $rent_range_options[0] = 'none - none'; }
  $start_end_array = billing_start_end($rent_range_options[0]);
  $select_statement = '<div class="add_free_rent_item"><a class="rs-freerent-delete ir" href="#">Remove</a><select name="data[Unit][99][free_rent]" class="UnitFreeRent"><option value="" selected="selected">Select Billing Period</option>';
  
  for(var i=0; i < $rent_range_options.length; i++){
    $only_end_dt = $rent_range_options[i].split("-");
    $select_statement = $select_statement + '<option value="' + $rent_range_options[i] + '">' + $only_end_dt[0].trim() + '</option>';
  }
  $select_statement = $select_statement + '</select>';
  
  $select_statement = $select_statement + '<?php  echo '<div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>' . trim($this->Form->input('FreeRent.99.amount', array('type'=>'text','pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01','placeholder' => 'Amount', 'class' => 'free_rent_amount' ))).'</div>'; echo trim($this->Form->hidden('FreeRent.99.billing_start',array('class' => 'free_rent_start','value'=>''))); echo trim($this->Form->hidden('FreeRent.99.billing_end',array('class' => 'free_rent_end','value'=>''))); ?></div>';

  $select_statement = $select_statement.replace(/\[99\]/g,'['+ $num + ']');
  $select_statement = $select_statement.replace(/FreeRent99/g,'Fee'+$num); 
  
  jQuery('#free_rent_block').fadeIn().append($select_statement);
  //jQuery('#Fee'+$num+'BillingStart').val($start_end_array[0]);
  //jQuery('#Fee'+$num+'BillingEnd').val($start_end_array[1]);

  // gw 2014-11-12  - get rid of commas in free rent field
  // Had to modify field to be type text with proper 'step', and I set a pattern as well
  jQuery('#Fee'+$num+'Amount').on('change',function(){
           jQuery(this).val(jQuery(this).val().replace(/,/g,''));
           return true;
  });
  
  jQuery('.UnitFreeRent').change(function(){
      //console.log(jQuery(this).val());
      $start_end_array = billing_start_end(jQuery(this).val());
      jQuery(this).siblings('.free_rent_start').val($start_end_array[0]);
      jQuery(this).siblings('.free_rent_end').val($start_end_array[1]);
  });
  //Remove Free Rent
  jQuery('.rs-freerent-delete').click(function(e){
    e.preventDefault();
    jQuery(this).parent('.add_free_rent_item').remove();
  });
  
}
function billing_start_end(selected_date){
  start_end = [];
  // if billing freq is daily set start and end to same date
  if(selected_date.indexOf("-") == -1){
    start_end.push(selected_date);
    start_end.push(selected_date);
    return start_end;
  } else {
    start_end = selected_date.split(" - ");
    return start_end;
  }
}


  
</script>
