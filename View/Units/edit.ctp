<div id="edit_unit">
<?php $unit_number =  $unit['Unit']['number']; 
      $rent = $unit['Unit']['rent'];
 ?>
<br>
<!-- Add Delte Unit Form -->
<?php echo $this->element('unit_delete',array('unit_number'=>$unit_number,'unit_id'=>$unit['Unit']['id'],'property_id'=>$unit['Unit']['property_id'])); ?>

<!-- Start Edit Unit Form -->
<?php 
    echo $this->Form->create('Unit', array('controller' => 'Units', 'action' => 'edit','inputDefaults' => array(
      'label' => false,
      'div' => false
      )));
?>

<div class="page_title">

  <div class="unit_number">
  <h1><span>UNIT </span><?php echo $unit_number; ?></h1>
  <h2><?php echo $unit['Unit']['beds']; ?> <span>Bedroom</span>  
      <?php echo $unit['Unit']['baths']; ?> <span>Bathrooms</span>  
      <?php echo number_format($unit['Unit']['square_feet']); ?> <span>Square Feet</span> 
      <?php if($unit['Unit']['square_feet'] != 0 && $unit['Unit']['square_feet'] != null && $unit['Unit']['square_feet'] != "") 
        switch ($this->data['Unit']['billing_frequency']) {
            case 1:
                echo '$'.sprintf ("%.2f", ((int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'])*30 ) . '<span>/SF</span>';
                break;
            case 2:
                echo '$'.sprintf ("%.2f", ((int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'])*4 ) . '<span>/SF</span>';
                break;
            case 3:
                echo '$'.sprintf ("%.2f", ((int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'])*2 ) . '<span>/SF</span>';
                break;
            case 4:
                echo '$'.sprintf ("%.2f", (int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'] ) . '<span>/SF</span>';
                break;
            case 5:
                echo '$'.sprintf ("%.2f", ((int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'])/3 ) . '<span>/SF</span>';
                break;
            case 6:
                echo '$'.sprintf ("%.2f", ((int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'])/6 ) . '<span>/SF</span>';
                break;
            case 7:
                echo '$'.sprintf ("%.2f", ((int)$unit['Unit']['rent'] / (int)$unit['Unit']['square_feet'])/12 ) . '<span>/SF</span>';
                break;    
                
        }
        ?>
      </h2>
  <div class="top_right_button delete_unit">
    <?php echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success save_unit_edit','escape' => false )); ?>
  </div><!-- .delete_unit -->
</div><!-- unit_number -->
</div><!-- .page_title -->
<div class="clear"><br><br></div>


<div class="unit_charges half_width">
  <div class="block_title">Unit Charges <a href="#" rel="clickover" class="edit_add_charge" data-original-title="Select Type of Charge" data-content="<a class='btn btn-small add_rec_charge' href='#'><i class='icon-refresh'></i>Recurring</a> <a class='btn btn-small add_one_charge' href='#'><i class='icon-calendar'></i>One Time</a>">Add Charge <i class="icon-plus-sign icon-white"></i></a></div>
  <div class="block_content">
  <h2 class="charge_type">Recurring Charges</h2>
    <?php
    echo '<div class="form_input">';
          	echo '<label class="base_rent_label" for="UnitRent">Base Rent</label><div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>';
          	echo $this->Form->input('Unit.rent', array('placeholder' => 'Rent','class'=>'dollar_input','type'=>'text','pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01'));
          	echo '</div>';
        echo '</div><!-- .form_input -->';
        echo '<div class="fees_section recurring" class="form_input">';
        $count = 0;
        foreach($unit['UnitFee'] as $fee){
            if($fee['one_time'] != "1"):
              echo '<div id="fee_' . $count . '" class="additional_fee">';
              echo $this->Form->input('UnitFee.'.$count.'.name', array('placeholder' => 'Fee Name', 'class' => 'fee_name' , 'label'=>false ,'div'=>false));
              echo '<div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>' . $this->Form->input('UnitFee.'.$count.'.amount', array('placeholder' => 'Fee Amount','class'=>'dollar_input','label'=>false,'div'=>false)) . '</div>';
              echo $this->Form->hidden('UnitFee.'.$count.'.unit_id');
              echo $this->Form->hidden('UnitFee.'.$count.'.id');
              echo '<a id="fee_id_'.$fee['id'].'" class="rs-button-delete ir rs-delete-edit-unit" href="#unit_delete_fee_'.$fee["id"].'" role="button", data-toggle = "modal">Remove</a></div><!-- .additional_fee -->';

            endif;
            $count++;
        }
        echo '</div>';
      ?>
  <h2 class="charge_type top-10">One Time Charges</h2>
  <?php
  $count = 0;
  echo '<div class="fees_section one_time" class="form_input">';
        foreach($unit['UnitFee'] as $fee){
        
            if($fee['one_time'] == "1"):
              echo '<div id="fee_' . $count . '" class="additional_fee">';
              echo $this->Form->input('UnitFee.'.$count.'.name', array('placeholder' => 'Fee Name', 'class' => 'fee_name' , 'label'=>false ,'div'=>false ));
              echo '<div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>' . $this->Form->input('UnitFee.'.$count.'.amount', array('placeholder' => 'Fee Amount','class'=>'dollar_input', 'label'=>false,'div'=>false )) . '</div>';
              echo $this->Form->input('UnitFee.'.$count.'.one_time_date', array('type'=>'text','placeholder' => 'Fee Date','class' => 'datepicker one_time_date_input','div'=>false,'label'=>false));
              echo $this->Form->hidden('UnitFee.'.$count.'.unit_id');
              echo $this->Form->hidden('UnitFee.'.$count.'.id');
              echo '<a id="fee_id_'.$fee['id'].'" class="rs-button-delete ir rs-delete-one-time" href="#unit_delete_fee_'.$fee["id"].'" role="button", data-toggle = "modal">Remove</a>';
              echo '</div><!-- .additional_fee -->';
            endif;
            $count++;
        }
        echo '</div>';
  ?>
  </div><!-- .block_content -->
</div><!-- .unit_charges -->

<div class="lease_info half_width_last">
  <div class="block_title">Lease Information</div>
  <div class="block_content">
    <div class="form_input">
      <?php echo $this->Form->hidden('Unit.prev_lease_start');
            if((string)$this->data['Unit']['lease_start'] == '01/01/1753' || (string)$this->data['Unit']['lease_start'] == '01/01/1970' || (strtotime($this->data['Unit']['lease_start']) < strtotime('01/01/2000'))){
              $placeholder = 'N/A';
               $value = '';
            } else {
              $placeholder = 'Start Date';
              $value = $this->data['Unit']['lease_start'];
            }
            echo $this->Form->input('Unit.lease_start', array('type'=>'text', 'label' => 'Lease Start','placeholder' => $placeholder, 'class' => 'datepicker', 'value'=>$value)); ?>
    </div><!-- .form_input -->
    <div class="form_input">
      <?php 
            if((string)$this->data['Unit']['lease_end'] == '01/01/1753' || (string)$this->data['Unit']['lease_end'] == '01/01/1970' || (strtotime($this->data['Unit']['lease_end']) < strtotime('01/01/2000'))){
              $placeholder = 'N/A';
               $value = '';
            } else {
              $placeholder = 'End Date';
              $value = $this->data['Unit']['lease_end'];
            }
            echo $this->Form->input('Unit.lease_end', array('type'=>'text', 'label' => 'Lease End','placeholder' => $placeholder, 'class' => 'datepicker', 'value'=>$value)); ?>
    </div><!-- .form_input -->

    <div class="form_input">
      <?php 
        echo $this->Form->hidden('Unit.prev_billing_frequency');
        echo $this->Form->input('Unit.billing_frequency',array('label' => 'Billing Frequency','type'=>'select','options'=>$frequency,'default'=>'4')); ?>
    </div><!-- .form_input -->
    <div class="form_input">
      <?php echo '<div id="freq_weekly" class="hide_input freq_input">';
              echo $this->Form->hidden('Unit.prev_weekly_day'); 
          		echo $this->Form->input('Unit.weekly_day', array('type'=>'select', 'options'=>array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'), 'label'=>'Rent is due on &nbsp;'));
          	echo '</div><!-- #freq_weekly -->';
          	echo '<div id="freq_twice_month" class="hide_input freq_input">';
          		echo '*Rent is due on the 1st and 15th of each month.';
          	echo '</div><!-- #freq_weekly -->';
          	echo '<div id="freq_monthly" class="hide_input freq_input">';
          	  echo $this->Form->hidden('Unit.prev_monthly_day');
          		echo $this->Form->input('Unit.monthly_day', array('type'=>'select', 'options'=>array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','last'), 'label'=>'Rent is due on the &nbsp;')) . ' &nbsp;&nbsp;&nbsp;day of the month';
          	echo '</div><!-- #freq_weekly -->';
          	echo '<div id="freq_yearly" class="hide_input freq_input">';
          	  echo $this->Form->hidden('Unit.prev_yearly_date');
          		echo $this->Form->input('Unit.yearly_date', array('type'=>'text','label' => 'Billing start date','placeholder' => 'Start Date','class' => 'datepicker'));
          	echo '</div><!-- #freq_weekly -->';
        ?>
    </div><!-- .form_input -->
    <div class="form_input">
      <label class="free_rent_label">Free Rent</label>
      <div id="free_rent_section">
         
      	 <?php $free_rent_count = 0;
      	 foreach($unit['FreeRent'] as $free_rent){
              echo '<div id="free_rent_' . $free_rent_count . '" class="free_rent_item">';
              echo '<span class="free_rent_period">' . $free_rent['billing_end'] . '</span><span class="free_rent_amount">$' . $free_rent['amount'] . '</span>';
              echo '<a id="free_rent_id_'.$free_rent['id'].'" class="rs-button-delete ir rs-delete-free-rent" href="#unit_delete_free_rent_'.$free_rent["id"].'" role="button", data-toggle = "modal">Remove</a>';
              echo '</div><!-- .additional_free_rent -->';
            $free_rent_count++;
         } ?>
        <span class="new_free_rent"></span>
        <a class="" id="add_free_rent"><i class="icon-plus-sign"></i> Add Free Rent</a>
      </div><!-- #free_rent_section -->
      <div class="clear"></div>
      
    </div><!-- .form_input -->
    <div class="clear"><br></div>
  </div><!-- .block_content -->
</div><!-- .lease_info -->

<div class="clear"><br><br></div>

<div class="resident_info ">
  <div class="block_title">Resident Information
  <?php echo $this->Html->link('Add Resident <i class="icon-plus-sign icon-white"></i>', '#add_resident_modal_'.$unit_number, array('class' => 'btn_add_resident', 'id' => 'add_res_modal_'.$unit_number, 'role'=>'button', 'data-toggle' => 'modal', 'escape' => false)); ?>
  </div>
  <table class="resident_info_edit_unit">
    <thead>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Phone Number</th>
      <th>Email Address</th>
      <th>Status</th>
    </thead>
    <tbody>
    <?php foreach($unit['Tenant'] as $tenant): ?>
      <tr>
        <td><?php echo $this->Html->link($tenant['first_name'], array('controller' => 'Users', 'action' => 'view', $tenant['id']), array('escape' => false)); ?>
        </td>
        <td><?php echo $tenant['last_name']; ?></td>
        <td><?php echo $tenant['phone']; ?></td>
        <td><a href="mailto:<?php echo $tenant['email']; ?>"><?php echo $tenant['email']; ?></a></td>
        <td><?php if($tenant['is_activated']) echo 'Active';
                  else if($tenant['invitebyemail'] && !$tenant['is_activated']) echo 'Invited (awaiting response)';
                  else echo 'Inavtive'; ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if(count($unit['Tenant']) == 0): ?>
    <tr>
    	<td colspan="5" style="text-align:center; padding:10px 0; color:#c4c4c4;">
      	Currently No Residents In This Unit
    	</td>
    </tr>
    <?php endif; ?>
    </tbody>
  </table>
</div><!-- .lease_info -->
<br><br>
<?php echo $this->Html->link('<i class="icon-trash icon-white"></i> Delete Unit', '#delete_unit_modal_'.$unit_number, array('class' => 'btn btn-danger', 'id' => '#delete_unit_modal_'.$unit_number, 'role'=>'button', 'data-toggle' => 'modal', 'escape' => false)); ?>
<?php echo $this->Form->button("<i class='icon-wrench icon-white'></i> Save", array('class' => 'btn btn-success save_unit_edit','escape' => false )); ?>
<?php echo $this->Form->end(); ?>

<?php echo $this->element('unit_add_resident',array('unit'=>$unit,'queuedTenants'=>$queuedTenants)); ?>
<?php 
      $count = 0;
      foreach($unit['UnitFee'] as $fee){
           // Add Delte Unit Fee Form
           echo $this->element('unit_delete_fee',array('fee_name'=>$this->data['UnitFee'][$count]['name'],'fee_id'=>$fee['id'],'fee_amt'=>$this->data['UnitFee'][$count]['amount']));
           $count++;
      }
      $count = 0;
      foreach($unit['FreeRent'] as $free_rent){
           // Add Delte Unit Fee Form
           echo $this->element('unit_delete_free_rent',array('free_rent_id'=>$free_rent['id'],'fr_start'=>$free_rent['billing_start'],'fr_end'=> $free_rent['billing_end'],'fr_amount'=> $free_rent['amount']));
           $count++;
      }
 ?>
              


</div><!-- .edit_unit -->


<script>
var shouldConfirm = false;
var $strNum = <?php echo $count; ?>;
var $free_rent_num = <?php echo $free_rent_count; ?>;
//On Page Load
jQuery(function(){
	//Set datepicker
	jQuery('.datepicker').datepicker({
  	changeMonth: true,
    changeYear: true
	});
	
	jQuery('.resident_info_edit_unit tr td').not('.delete_resident').click(function() {
      var href = jQuery(this).parent().children('td').first().children('a').attr('href');
      if(href) {
          window.location = href;
      }
  });
    
	//Add Fee button
	  
  jQuery('a.edit_add_charge').clickover({
        html : true,
        placement:'left',
        animation: true
  });
  jQuery('a.edit_add_charge').click(function(){
      jQuery('.add_one_charge,.add_rec_charge').click(function(e) {
        e.preventDefault();
        shouldConfirm = true;
        if($strNum == null || $strNum == ""){
          $num="0";
          $strNum = "0";
        } else {
          $num = parseInt($strNum,10) + 1;
          $num = $num.toString();
          $strNum = $num;
        }
        if(jQuery(this).hasClass('add_one_charge')){
          $append = '<div id="fee_' + $num + '" class="additional_fee"><?php
                  echo trim($this->Form->input('UnitFee.99.name', array('placeholder' => 'Fee Name', 'class' => 'fee_name', 'label'=>false ,'div'=>false )));
                  echo '<div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>'.trim($this->Form->input('UnitFee.99.amount', array('placeholder' => 'Fee Amount','class'=>'dollar_input', 'label'=>false ,'div'=>false))) . '</div>';
                  echo trim($this->Form->input('UnitFee.99.one_time_date', array('type'=>'text','placeholder' => 'Fee Date','class' => 'onetimedatepicker', 'label'=>false ,'div'=>false)));
                  echo $this->Form->hidden('UnitFee.99.one_time',array( 'value' => 1 ));
                ?></div><!-- .additional_fee -->'.replace(/\[99\]/g,'['+ $num + ']');
            $append = $append.replace(/Fee99/g,'Fee'+$num); 
            jQuery('.fees_section.one_time').append($append);
        } else {
          $append = '<div id="fee_' + $num + '" class="additional_fee"><?php
                echo trim($this->Form->input('UnitFee.99.name', array('placeholder' => 'Fee Name', 'class' => 'fee_name', 'label'=>false ,'div'=>false )));
                echo '<div class="input-prepend"><span class="add-on"><i class="icon">$</i></span>'.trim($this->Form->input('UnitFee.99.amount', array('placeholder' => 'Fee Amount', 'label'=>false ,'div'=>false))) . '</div>';
              ?></div><!-- .additional_fee -->'.replace(/\[99\]/g,'['+ $num + ']');
          $append = $append.replace(/Fee99/g,'Fee'+$num); 
          jQuery('.fees_section.recurring').append($append);
        }
        jQuery('.onetimedatepicker').datepicker({
        	changeMonth: true,
          changeYear: true
      	});

        jQuery('a.edit_add_charge').click();
      });
  });
    
/*
  //Remove Fee a.rs-delete-edit-unit
  jQuery('a.rs-delete-edit-unit,a.rs-delete-one-time').click(function(e){
	  e.preventDefault();
	  $jthis = jQuery(this);
  	jQuery.ajax({
      url: '/Units/deleteUnitCharge/' + jQuery(this).attr('id').replace('fee_id_',''),
      failure: function(data) {
        alert('Delete Unit Charge failed. Please contact site admin.');
      },
      success: function(data){
        //console.log(jQuery(this));
        $jthis.parent().slideUp('slow',function(){
          jQuery(this).remove();
        });
      }
    });
	});

	
	//Remove Free Rent
	jQuery('a.rs-delete-free-rent').click(function(e){
	  e.preventDefault();
	  $jthis = jQuery(this);
  	jQuery.ajax({
      url: '/Units/deleteFreeRent/' + jQuery(this).attr('id').replace('free_rent_id_',''),
      failure: function(data) {
        alert('Delete Free Rent failed. Please contact site admin.');
      },
      success: function(data){
        //console.log(jQuery(this));
        $jthis.parent().slideUp('slow',function(){
          jQuery(this).remove();
        });
      }
    });
	});
*/

  //Billing Frequency Additional Information
  jQuery('#UnitBillingFrequency').change(function(){
    var retVal = confirm("This will delete all Free Rents.  You will need to re-add them based on new billing periods");
    if (retVal == true)
    {
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
   
       var unitId = '<?php echo $unit["Unit"]["id"]; ?>';
      
       // Delete free_rent items
       jQuery.ajax({
          url: '/Units/deleteUnitFreeRents/' + unitId,
          failure: function(data) {
              alert('Delete Free Rent failed. Please contact site admin.');
          },
          success: function(data){
             // Hide free rents we just deleted server side
             jQuery('[class^="free_rent_item"]').each(function(){
                console.log(jQuery(this).find('.free_rent_period').text());
                $freeRentDate = new Date(jQuery(this).find('.free_rent_period').text()).getTime();
                console.log( $freeRentDate );
                $todaysDate = new Date().getTime();
                if ($todaysDate < $freeRentDate)		//GSW Aug 27 -  if no freerentdate, hide as well??
                {
                   jQuery(this).hide();
                }
             });
          }
       });

       return true;
    }
    else
    {
       return false;
    }
  });
  
  //Free Rent
  jQuery('#add_free_rent').click(function (){
    free_rent();
    jQuery(this).addClass('move_left');
    shouldConfirm = true;
  });


   jQuery('#UnitRent').on('change',function(e1){
            jQuery(this).val(jQuery(this).val().replace(/,/g,''));
            return true;
   });
  
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
  $select_statement = '<div class="add_free_rent_item"><select name="data[Unit][99][free_rent]" class="UnitFreeRent"><option value="" selected="selected">Select Due Date</option>';
  
  for(var i=0; i < $rent_range_options.length; i++){
    $only_end_dt = $rent_range_options[i].split("-");
    $select_statement = $select_statement + '<option value="' + $rent_range_options[i] + '">' + $only_end_dt[0].trim() + '</option>';
  }
  $select_statement = $select_statement + '</select>';
  $select_statement = $select_statement + '<?php echo trim($this->Form->input('FreeRent.99.amount', array('placeholder' => 'Amount', 'class' => 'free_rent_amount' , 'label'=>false ,'div'=>false,'type'=>'text','pattern'=>'[0-9]+([\,|\.][0-9]+)?','step'=>'0.01'))); echo '<span class="frent_delete" style="width: 18px; float: right;"><a class="rs-button-delete ir rs-delete-edit-unit" href="#frent_delete_FreeRent99" role="button">Remove</a></span>'; ?>';

  $slect_statement = $select_statement + '<?php echo trim($this->Form->hidden('FreeRent.99.billing_start',array('class' => 'free_rent_start'))); echo trim($this->Form->hidden('FreeRent.99.billing_end',array('class' => 'free_rent_end'))); ?></div>';

  
  $select_statement = $select_statement.replace(/\[99\]/g,'['+ $num + ']');
  $select_statement = $select_statement.replace(/FreeRent99/g,'Fee'+$num); 
  
  jQuery('#free_rent_section').find('.new_free_rent').append($select_statement);
  jQuery('.frent_delete').unbind('click').click(function(){ jQuery(this).parent().remove(); });
  jQuery('#Fee'+$num+'BillingStart').val($start_end_array[0]);
  jQuery('#Fee'+$num+'BillingEnd').val($start_end_array[1]);

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


switch(jQuery('#UnitBillingFrequency').val()){
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


window.onbeforeunload = function() {
   if(shouldConfirm) {
       return "You have not saved your changes. Are you sure you want to continue without saving? Please remain on this page and click Save if you would like to keep your changes.";
   }
}
jQuery('#UnitRent,#UnitLeaseStart,#UnitLeaseEnd,#UnitBillingFrequency,#UnitWeeklyDay,#UnitWeeklyDay,#UnitYearlyDate,.fee_name,.dollar_input,.UnitFreeRent,.free_rent_amount').change(function(){
  shouldConfirm = true;
});
jQuery('#UnitEditForm').submit(function(){
  shouldConfirm = false;
});

//Free Rent Delete before saved

</script>
